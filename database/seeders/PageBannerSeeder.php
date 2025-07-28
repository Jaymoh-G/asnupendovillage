<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageBanner;

class PageBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default page banners
        $pages = [
            'downloads' => [
                'title' => 'Downloads',
                'description' => 'Access our resources, documents, and materials for download.',
            ],
            'news' => [
                'title' => 'News & Updates',
                'description' => 'Stay updated with our latest news and announcements.',
            ],
            'contact-us' => [
                'title' => 'Contact Us',
                'description' => 'Get in touch with us for any inquiries or support.',
            ],
            'gallery' => [
                'title' => 'Gallery',
                'description' => 'Browse through our photo gallery and visual content.',
            ],
            'team' => [
                'title' => 'Our Team',
                'description' => 'Meet our dedicated team members and volunteers.',
            ],
            'testimonials' => [
                'title' => 'Testimonials',
                'description' => 'Read what others have to say about our work.',
            ],
            'faqs' => [
                'title' => 'Frequently Asked Questions',
                'description' => 'Find answers to commonly asked questions.',
            ],
            'donate-now' => [
                'title' => 'Donate Now',
                'description' => 'Support our cause and make a difference today.',
            ],
            'careers' => [
                'title' => 'Careers',
                'description' => 'Join our team and be part of something meaningful.',
            ],
            'media-centre' => [
                'title' => 'Media Centre',
                'description' => 'Access our media resources and press materials.',
            ],
        ];

        foreach ($pages as $pageName => $pageData) {
            PageBanner::updateOrCreate(
                ['page_name' => $pageName],
                [
                    'title' => $pageData['title'],
                    'description' => $pageData['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
