<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admin user and roles will be created by AdminUserSeeder

        // Seed page banners, news, projects, testimonials, team members, programs, home sliders, and home slider images
        $this->call([
            AdminUserSeeder::class,
            PageBannerSeeder::class,
            NewsSeeder::class,
            ProjectSeeder::class,
            TestimonialSeeder::class,
            TeamSeeder::class,
            ProgramSeeder::class,
            HomeSliderSeeder::class,
            HomeSliderImageSeeder::class,
            HomePageContentSeeder::class,
            DonationSeeder::class,
            DonationStaticPageSeeder::class,
            CoreValueSeeder::class,
            StatisticSeeder::class,
            YouTubeSeeder::class,
        ]);
    }
}
