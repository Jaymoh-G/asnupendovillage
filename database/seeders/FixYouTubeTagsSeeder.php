<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YouTube;
use Illuminate\Support\Facades\DB;

class FixYouTubeTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Fixing YouTube video tags...');

        $videos = YouTube::all();
        $fixedCount = 0;

        foreach ($videos as $video) {
            $originalTags = $video->getRawOriginal('tags');

            // Check if tags are stored as a string instead of JSON
            if (is_string($originalTags) && !empty($originalTags)) {
                try {
                    // Try to decode as JSON first
                    $decoded = json_decode($originalTags, true);

                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        // It's valid JSON, no need to fix
                        continue;
                    }

                    // If it's not valid JSON, it might be a comma-separated string
                    if (str_contains($originalTags, ',')) {
                        $tagsArray = array_map('trim', explode(',', $originalTags));
                    } else {
                        $tagsArray = [trim($originalTags)];
                    }

                    // Update the database directly to avoid any model casting issues
                    DB::table('youtube_videos')
                        ->where('id', $video->id)
                        ->update(['tags' => json_encode($tagsArray)]);

                    $fixedCount++;
                    $this->command->info("Fixed tags for video ID {$video->id}: '{$originalTags}' -> " . json_encode($tagsArray));
                } catch (\Exception $e) {
                    $this->command->error("Error fixing tags for video ID {$video->id}: " . $e->getMessage());
                }
            }
        }

        if ($fixedCount > 0) {
            $this->command->info("Fixed {$fixedCount} videos with invalid tags.");
        } else {
            $this->command->info('All YouTube video tags are properly formatted.');
        }
    }
}
