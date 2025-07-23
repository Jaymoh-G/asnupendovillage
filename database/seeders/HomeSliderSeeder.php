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
                'description' => 'Join us in making a difference in the lives of those who need it most. Together, we can build a brighter future for everyone.',
                'button_text' => 'Donate Now',
                'button_url' => '/donate-now',
                'status' => 'active',
                'sort_order' => 1,
                'is_featured' => true,
                'meta_title' => 'ASN Upendo Village - Empowering Communities',
                'meta_description' => 'Join ASN Upendo Village in making a difference. Support our community programs and help build a brighter future.',
            ],
            [
                'title' => 'Every Donation Counts, Every Heart Matters',
                'subtitle' => 'Make a Difference Today',
                'description' => 'Your contribution, no matter how small, can create lasting change in the lives of vulnerable communities. Every donation helps us provide essential services.',
                'button_text' => 'Learn More',
                'button_url' => '/about',
                'status' => 'active',
                'sort_order' => 2,
                'is_featured' => true,
                'meta_title' => 'Make a Difference - ASN Upendo Village',
                'meta_description' => 'Your donation can create lasting change. Support our programs and help vulnerable communities thrive.',
            ],
            [
                'title' => 'Building Hope, One Life at a Time',
                'subtitle' => 'Community Development Programs',
                'description' => 'Through education, healthcare, and community support, we are building sustainable futures for families and communities in need.',
                'button_text' => 'Our Programs',
                'button_url' => '/programs',
                'status' => 'active',
                'sort_order' => 3,
                'is_featured' => false,
                'meta_title' => 'Community Development - ASN Upendo Village',
                'meta_description' => 'Discover our community development programs focused on education, healthcare, and sustainable futures.',
            ],
        ];

        foreach ($sliders as $sliderData) {
            HomeSlider::create($sliderData);
        }
    }
}
