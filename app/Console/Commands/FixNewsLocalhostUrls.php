<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

class FixNewsLocalhostUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fix-localhost-urls {--news-id= : Fix specific news article by ID} {--dry-run : Show what would be changed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix hardcoded localhost URLs in news content to use APP_URL configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsId = $this->option('news-id');
        $dryRun = $this->option('dry-run');

        if ($newsId) {
            $news = News::find($newsId);
            if (!$news) {
                $this->error("News article with ID {$newsId} not found.");
                return 1;
            }

            $this->fixNewsArticle($news, $dryRun);
        } else {
            $this->info('Fixing localhost URLs in all news articles...');
            $newsArticles = News::all();

            $bar = $this->output->createProgressBar($newsArticles->count());
            $bar->start();

            foreach ($newsArticles as $news) {
                $this->fixNewsArticle($news, $dryRun);
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
        }

        if ($dryRun) {
            $this->info('Dry run completed! No changes were made.');
        } else {
            $this->info('URL fixing completed!');
        }

        return 0;
    }

    /**
     * Fix a single news article
     */
    protected function fixNewsArticle(News $news, bool $dryRun): void
    {
        if (empty($news->content)) {
            return;
        }

        $originalContent = $news->content;
        $newContent = $this->replaceLocalhostUrls($originalContent);

        if ($originalContent !== $newContent) {
            if ($dryRun) {
                $this->info("Would update news article: {$news->title}");
                $this->line("  - Found localhost URLs that would be replaced");
            } else {
                $news->update(['content' => $newContent]);
                $this->info("Updated news article: {$news->title}");
            }
        }
    }

    /**
     * Replace localhost URLs with proper APP_URL
     */
    protected function replaceLocalhostUrls(string $content): string
    {
        $appUrl = config('app.url');
        $appUrl = rtrim($appUrl, '/'); // Remove trailing slash

        // Replace various localhost patterns
        $replacements = [
            'http://localhost/storage/' => $appUrl . '/storage/',
            'https://localhost/storage/' => $appUrl . '/storage/',
            'http://127.0.0.1:8000/storage/' => $appUrl . '/storage/',
            'https://127.0.0.1:8000/storage/' => $appUrl . '/storage/',
            'http://localhost:8000/storage/' => $appUrl . '/storage/',
            'https://localhost:8000/storage/' => $appUrl . '/storage/',
        ];

        foreach ($replacements as $oldUrl => $newUrl) {
            $content = str_replace($oldUrl, $newUrl, $content);
        }

        return $content;
    }
}
