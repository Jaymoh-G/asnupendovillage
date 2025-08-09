<?php

namespace Database\Seeders;

use App\Models\HomeSlider;
use Illuminate\Database\Seeder;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Empowering Communities Through Compassion',
                'subtitle' => 'Welcome to ASN Upendo Village',
                'description' => 'Join us in making a difference in the lives of those who need it most. Together, we can build a brighter future for everyone through education, healthcare, and community development.',
                'button_text' => 'Donate Now',
                'button_url' => '/donate-now',
                'slug' => 'empowering-communities-through-compassion',
                'status' => 'active',
                'sort_order' => 1,
                'is_featured' => true,
                'meta_title' => 'ASN Upendo Village - Empowering Communities',
                'meta_description' => 'Join ASN Upendo Village in empowering communities through compassion, education, and sustainable development.',
            ],
            [
                'title' => 'Building Hope Through Education',
                'subtitle' => 'Education for All',
                'description' => 'We believe that education is the foundation of sustainable development. Our programs provide quality learning opportunities for children and adults, creating pathways to a better future.',
                'button_text' => 'Learn More',
                'button_url' => '/programs',
                'slug' => 'building-hope-through-education',
                'status' => 'active',
                'sort_order' => 2,
                'is_featured' => true,
                'meta_title' => 'Education Programs - ASN Upendo Village',
                'meta_description' => 'Discover our education programs designed to provide quality learning opportunities for all.',
            ],
            [
                'title' => 'Healthcare for Everyone',
                'subtitle' => 'Quality Healthcare Access',
                'description' => 'Access to quality healthcare is a fundamental human right. Our healthcare programs ensure that communities have access to essential medical services and health education.',
                'button_text' => 'Get Involved',
                'button_url' => '/programs',
                'slug' => 'healthcare-for-everyone',
                'status' => 'active',
                'sort_order' => 3,
                'is_featured' => false,
                'meta_title' => 'Healthcare Programs - ASN Upendo Village',
                'meta_description' => 'Access to quality healthcare programs and services for communities in need.',
            ],
            [
                'title' => 'Sustainable Community Development',
                'subtitle' => 'Building Tomorrow Together',
                'description' => 'We work with communities to develop sustainable solutions that address their unique challenges and create lasting positive change.',
                'button_text' => 'Learn More',
                'button_url' => '/about-us',
                'slug' => 'sustainable-community-development',
                'status' => 'active',
                'sort_order' => 4,
                'is_featured' => false,
                'meta_title' => 'Community Development - ASN Upendo Village',
                'meta_description' => 'Building sustainable communities through collaborative development programs.',
            ],
            [
                'title' => 'Emergency Relief & Support',
                'subtitle' => 'Crisis Response',
                'description' => 'When disasters strike, we respond quickly to provide emergency relief and support to affected communities, helping them recover and rebuild.',
                'button_text' => 'Support Us',
                'button_url' => '/donate-now',
                'slug' => 'emergency-relief-and-support',
                'status' => 'active',
                'sort_order' => 5,
                'is_featured' => false,
                'meta_title' => 'Emergency Relief - ASN Upendo Village',
                'meta_description' => 'Providing emergency relief and support to communities affected by disasters.',
            ],
        ];

        foreach ($sliders as $sliderData) {
            HomeSlider::firstOrCreate(
                ['title' => $sliderData['title']],
                $sliderData
            );
        }
    }
}
