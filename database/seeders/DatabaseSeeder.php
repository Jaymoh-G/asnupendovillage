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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Seed page banners, news, projects, testimonials, team members, programs, home sliders, and home slider images
        $this->call([
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
            CoreValueSeeder::class,
            StatisticSeeder::class,
            AboutUsStaticPageSeeder::class,
        ]);
    }
}
