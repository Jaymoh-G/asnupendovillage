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
            [
                'page_name' => 'about-us',
                'title' => 'About Us',
                'description' => 'Learn more about ASN Upendo Village and our mission to make a positive impact in the community.',
                'banner_image_path' => null,
                'banner_image_alt' => 'About Us Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'founder',
                'title' => 'Our Founder',
                'description' => 'Meet the visionary founder and CEO of ASN Upendo Village.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Founder Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'downloads',
                'title' => 'Downloads',
                'description' => 'Access important documents, forms, and resources from ASN Upendo Village.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Downloads Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'news',
                'title' => 'News & Updates',
                'description' => 'Stay updated with our latest news and announcements.',
                'banner_image_path' => null,
                'banner_image_alt' => 'News Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'events',
                'title' => 'Events & Activities',
                'description' => 'Discover our upcoming events and community activities.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Events Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'programs',
                'title' => 'Our Programs',
                'description' => 'Explore the programs we run to support our mission.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Programs Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'projects',
                'title' => 'Our Projects',
                'description' => 'See the projects we are working on to create impact.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Projects Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'facilities',
                'title' => 'Our Facilities',
                'description' => 'Learn more about our facilities and infrastructure.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Facilities Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'contact-us',
                'title' => 'Contact Us',
                'description' => 'Get in touch with us for any inquiries or support.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Contact Us Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'gallery',
                'title' => 'Gallery',
                'description' => 'Browse through our photo gallery and visual content.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Gallery Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'team',
                'title' => 'Our Team',
                'description' => 'Meet our dedicated team members and volunteers.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Team Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'testimonials',
                'title' => 'Testimonials',
                'description' => 'Read what others have to say about our work.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Testimonials Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'faqs',
                'title' => 'Frequently Asked Questions',
                'description' => 'Find answers to commonly asked questions.',
                'banner_image_path' => null,
                'banner_image_alt' => 'FAQs Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'donate-now',
                'title' => 'Donate Now',
                'description' => 'Support our cause and make a difference today.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Donate Now Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'donation',
                'title' => 'Support Our Mission',
                'description' => 'Your generous donation helps us continue our work in supporting communities and making a positive impact in people\'s lives.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Donation Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'careers',
                'title' => 'Careers',
                'description' => 'Join our team and be part of something meaningful.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Careers Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'media-centre',
                'title' => 'Media Centre',
                'description' => 'Access our media resources and press materials.',
                'banner_image_path' => null,
                'banner_image_alt' => 'Media Centre Banner',
                'is_active' => true,
            ],
            [
                'page_name' => 'youtube-videos',
                'title' => 'YouTube Videos',
                'description' => 'Watch our latest videos and stories from the field.',
                'banner_image_path' => null,
                'banner_image_alt' => 'YouTube Videos Banner',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $pageData) {
            PageBanner::updateOrCreate(
                ['page_name' => $pageData['page_name']],
                [
                    'title' => $pageData['title'],
                    'description' => $pageData['description'],
                    'banner_image_path' => $pageData['banner_image_path'],
                    'banner_image_alt' => $pageData['banner_image_alt'],
                    'is_active' => $pageData['is_active'],
                ]
            );
        }
    }
}
