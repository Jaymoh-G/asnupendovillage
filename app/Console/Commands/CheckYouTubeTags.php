<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\YouTube;
use Illuminate\Support\Facades\DB;

class CheckYouTubeTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:check-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and fix YouTube video tags that might be stored as strings instead of arrays';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking YouTube video tags...');

        $videos = YouTube::all();
        $fixedCount = 0;

        foreach ($videos as $video) {
            if ($video->tags !== null && !is_array($video->tags)) {
                $this->warn("Video ID {$video->id} ({$video->title}) has invalid tags: " . gettype($video->tags));

                // Try to fix the tags
                if (is_string($video->tags)) {
                    // If it's a comma-separated string, convert to array
                    if (str_contains($video->tags, ',')) {
                        $tagsArray = array_map('trim', explode(',', $video->tags));
                        $video->tags = $tagsArray;
                    } else {
                        // If it's a single tag, wrap in array
                        $video->tags = [$video->tags];
                    }

                    $video->save();
                    $fixedCount++;
                    $this->info("  -> Fixed tags for video ID {$video->id}");
                }
            }
        }

        if ($fixedCount > 0) {
            $this->info("Fixed {$fixedCount} videos with invalid tags.");
        } else {
            $this->info('All YouTube video tags are properly formatted as arrays.');
        }

        return 0;
    }
}
