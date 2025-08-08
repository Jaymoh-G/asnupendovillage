<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class UpdateGoogleMap extends Command
{
    protected $signature = 'settings:update-google-map';
    protected $description = 'Update Google Maps link for contact page';

    public function handle()
    {
        $googleMapLink = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.819424!2d36.8176!3d-1.2921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1b90e87d30f7%3A0x38921a7a009a91ee!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2ske!4v1753067850826!5m2!1sen!2ske';

        Setting::updateOrCreate(
            ['key' => 'google_map_link'],
            [
                'value' => $googleMapLink,
                'type' => 'url',
                'group' => 'contact',
                'label' => 'Google Map Link',
                'description' => 'Google Maps embed link for location',
                'sort_order' => 4,
            ]
        );

        $this->info('Google Maps link updated successfully!');
        $this->info('New link: ' . $googleMapLink);
    }
}
