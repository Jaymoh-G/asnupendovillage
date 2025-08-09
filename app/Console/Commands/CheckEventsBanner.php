<?php

namespace App\Console\Commands;

use App\Models\PageBanner;
use Illuminate\Console\Command;

class CheckEventsBanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:events-banner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the events page banner status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking events page banner...');

        $banner = PageBanner::where('page_name', 'events')->first();
        
        if ($banner) {
            $this->info('✅ Found banner for events');
            $this->info("Title: {$banner->title}");
            $this->info("Image Path: " . ($banner->banner_image_path ?? 'No image'));
            $this->info("Image URL: " . ($banner->banner_image_url ?? 'No URL'));
            $this->info("Effective URL: " . ($banner->effective_banner_url ?? 'No effective URL'));
            $this->info("Active: " . ($banner->is_active ? 'Yes' : 'No'));
        } else {
            $this->error('❌ No banner found for events');
        }

        return 0;
    }
}
