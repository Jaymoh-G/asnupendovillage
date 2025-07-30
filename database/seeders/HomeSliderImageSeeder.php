<?php

namespace Database\Seeders;

use App\Models\HomeSlider;
use App\Models\Image;
use Illuminate\Database\Seeder;

class HomeSliderImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = HomeSlider::all();

        // Use actual image files that exist in the home-sliders directory
        $heroImages = [
            'home-sliders/01JZJR8XE7ST8NWMD8629APV6R.jpg',
            'home-sliders/01JZJRBGQ9RG52TB5SEE0YHKAT.jpg',
            'home-sliders/01K1DN1AFV0FR2XSMF6GH36B4S.jpg',
            'home-sliders/01K1DN4HE41FSCW8MPKWA0A6AS.jpg',
            'home-sliders/01K1DP19G9WR07T84892AB4977.jpg',
        ];

        foreach ($sliders as $index => $slider) {
            // Get a hero image (cycle through the available ones)
            $imagePath = $heroImages[$index % count($heroImages)];

            // Create image record for this slider
            $image = $slider->images()->create([
                'filename' => basename($imagePath),
                'original_name' => basename($imagePath),
                'path' => $imagePath,
                'mime_type' => 'image/jpeg',
                'size' => 1024000, // 1MB placeholder
                'alt_text' => $slider->title,
                'featured' => true,
                'sort_order' => 1,
            ]);
        }
    }
}
