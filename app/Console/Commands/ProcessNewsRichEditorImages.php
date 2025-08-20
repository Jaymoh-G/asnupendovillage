<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ProcessNewsRichEditorImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:process-rich-editor-images {--news-id= : Process specific news article by ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process images uploaded through RichEditor in news articles and create proper image records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsId = $this->option('news-id');

        if ($newsId) {
            $news = News::find($newsId);
            if (!$news) {
                $this->error("News article with ID {$newsId} not found.");
                return 1;
            }

            $this->processNewsArticle($news);
        } else {
            $this->info('Processing all news articles...');
            $newsArticles = News::all();

            $bar = $this->output->createProgressBar($newsArticles->count());
            $bar->start();

            foreach ($newsArticles as $news) {
                $this->processNewsArticle($news);
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
        }

        $this->info('Processing completed!');
        return 0;
    }

    /**
     * Process a single news article
     */
    protected function processNewsArticle(News $news): void
    {
        if (empty($news->content)) {
            return;
        }

        // Extract image paths from content
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $news->content, $matches);

        if (empty($matches[1])) {
            return;
        }

        $imagePaths = $matches[1];
        $processedCount = 0;

        foreach ($imagePaths as $imagePath) {
            // Convert URL to storage path
            $storagePath = $this->convertUrlToStoragePath($imagePath);

            if ($storagePath && !$this->imageRecordExists($news, $storagePath)) {
                // Create image record for this image
                $news->images()->create([
                    'filename' => basename($storagePath),
                    'original_name' => basename($storagePath),
                    'path' => $storagePath,
                    'mime_type' => 'image/jpeg', // Default
                    'size' => 0,
                    'alt_text' => pathinfo($storagePath, PATHINFO_FILENAME),
                    'caption' => null,
                    'featured' => false,
                    'sort_order' => $news->images()->count(),
                ]);

                $processedCount++;
            }
        }

        if ($processedCount > 0) {
            $this->info("Processed {$processedCount} images for news article: {$news->title}");
        }
    }

    /**
     * Convert image URL to storage path
     */
    protected function convertUrlToStoragePath($url): ?string
    {
        // Handle different URL formats
        $path = $url;

        // Remove protocol and domain
        $path = preg_replace('/^https?:\/\/[^\/]+\//', '', $path);

        // Remove /storage/ prefix if present
        $path = preg_replace('/^storage\//', '', $path);

        // Ensure the path exists in storage
        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        // Try alternative path formats
        $alternativePaths = [
            $path,
            'news/content/' . basename($path),
            'news/content/' . $path,
        ];

        foreach ($alternativePaths as $altPath) {
            if (Storage::disk('public')->exists($altPath)) {
                return $altPath;
            }
        }

        return null;
    }

    /**
     * Check if image record already exists for this path
     */
    protected function imageRecordExists($news, $path): bool
    {
        return $news->images()->where('path', $path)->exists();
    }
}
