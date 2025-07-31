<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomePageContent;

class HomePageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // About Us Section
        HomePageContent::create([
            'section_name' => 'about-us',
            'title' => 'We Believe that We can Save More Life\'s with you',
            'subtitle' => 'About Us Donat',
            'description' => 'Donet is the largest global crowdfunding community connecting nonprofits, donors, and companies in nearly every country. We help nonprofits from Afghanistan to Zimbabwe (and hundreds of places in between) access the tools, training, and support they need to be more effective and make our world a better place.',
            'button_text' => 'About More',
            'button_url' => 'about.html',
            'is_active' => true,
            'sort_order' => 1,
            'meta_data' => [
                'checklist_items' => [
                    ['text' => 'Charity For Foods', 'color' => null],
                    ['text' => 'Charity For Water', 'color' => 'var(--theme-color2)'],
                    ['text' => 'Charity For Education', 'color' => '#FF5528'],
                    ['text' => 'Charity For Medical', 'color' => '#122F2A'],
                ]
            ]
        ]);

        // Statistics Section
        HomePageContent::create([
            'section_name' => 'statistics',
            'title' => 'We Always Help The Needy People',
            'description' => 'Discover the inspiring stories of individuals and communities transformed by our programs. Our success stories highlight the real-life impact of your donations.',
            'is_active' => true,
            'sort_order' => 2,
            'meta_data' => [
                'statistics' => [
                    ['number' => '15', 'suffix' => 'k+', 'label' => 'Incredible Volunteers', 'color' => 'var(--theme-color2)'],
                    ['number' => '1', 'suffix' => 'k+', 'label' => 'Successful Campaigns', 'color' => null],
                    ['number' => '400', 'suffix' => '+', 'label' => 'Monthly Donors', 'color' => null],
                    ['number' => '35', 'suffix' => 'k+', 'label' => 'Team Support', 'color' => 'var(--theme-color2)'],
                ]
            ]
        ]);

        // CTA Section
        HomePageContent::create([
            'section_name' => 'cta-section',
            'title' => 'Our Door Are Always Open to More People Who Want to Support Each Others!',
            'button_text' => 'Get Involved',
            'button_url' => 'contact.html',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        // Story Section
        HomePageContent::create([
            'section_name' => 'story-section',
            'title' => 'We Help Fellow Nonprofits Access the Funding Tools, Training',
            'subtitle' => 'Success Story',
            'description' => 'Our secure online donation platform allows you to make contributions quickly and safely. Choose from various payment methods and set up one-time.exactly.',
            'button_text' => 'Our Success Story',
            'button_url' => 'about.html',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // Video Section
        HomePageContent::create([
            'section_name' => 'video-section',
            'title' => 'We Always Help The Needy People',
            'description' => 'Discover the inspiring stories of individuals and communities transformed by our programs. Our success stories highlight the real-life impact of your donations.',
            'video_url' => 'https://www.youtube.com/watch?v=_sI_Ps7JSEk',
            'is_active' => true,
            'sort_order' => 5,
        ]);
    }
}
