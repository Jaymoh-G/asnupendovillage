<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\YouTube;

class TestYouTubeTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:test-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test YouTube video tags to see what type they are when loaded';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing YouTube video tags...');

        $videos = YouTube::all();

        if ($videos->count() === 0) {
            $this->warn('No YouTube videos found in the database.');
            return 0;
        }

        foreach ($videos as $video) {
            $this->info("Video ID: {$video->id}, Title: {$video->title}");
            $this->info("  Tags type: " . gettype($video->tags));
            $this->info("  Tags value: " . json_encode($video->tags));
            $this->info("  Raw tags: " . $video->getRawOriginal('tags'));
            $this->info("  Raw tags type: " . gettype($video->getRawOriginal('tags')));

            // Test count function
            try {
                $count = count($video->tags);
                $this->info("  Count result: {$count}");
            } catch (\Exception $e) {
                $this->error("  Count error: " . $e->getMessage());
            }

            $this->info('  ---');
        }

        return 0;
    }
}
