<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Models\News;
use Illuminate\Console\Command;

class CheckImages extends Command
{
    protected $signature = 'check:images';
    protected $description = 'Check images in the database';

    public function handle()
    {
        $this->info('Checking images in database...');

        $images = Image::all();
        $this->info("Total images: {$images->count()}");

        foreach ($images as $image) {
            $linkedTo = $image->imageable_type ? "{$image->imageable_type} ID {$image->imageable_id}" : 'Nothing';
            $featured = $image->featured ? ' (Featured)' : '';
            $this->line("Image: {$image->filename} - Linked to: {$linkedTo}{$featured}");
        }

        $this->info("\nChecking news items...");
        $news = News::all();
        foreach ($news as $item) {
            $imageCount = $item->images()->count();
            $featuredImage = $item->featuredImage;
            $featuredInfo = $featuredImage ? " - Featured: {$featuredImage->filename}" : " - No featured image";
            $this->line("News: {$item->title} - Images: {$imageCount}{$featuredInfo}");
        }
    }
}
