<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YouTube;
use Carbon\Carbon;

class YouTubeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'ASN Upendo Village - Community Impact Stories',
                'description' => 'Discover how ASN Upendo Village is making a difference in our community through various charitable initiatives and programs.',
                'video_id' => 'dQw4w9WgXcQ',
                'duration' => '5:30',
                'published_at' => Carbon::now()->subDays(5),
                'is_featured' => true,
                'sort_order' => 1,
                'tags' => ['community', 'impact', 'charity'],
                'status' => 'active',
            ],
            [
                'title' => 'Volunteer Stories - Making a Difference Together',
                'description' => 'Meet our dedicated volunteers and hear their inspiring stories about helping others and building a stronger community.',
                'video_id' => '9bZkp7q19f0',
                'duration' => '8:15',
                'published_at' => Carbon::now()->subDays(10),
                'is_featured' => true,
                'sort_order' => 2,
                'tags' => ['volunteers', 'stories', 'community'],
                'status' => 'active',
            ],
            [
                'title' => 'Education Programs - Empowering Future Generations',
                'description' => 'Learn about our educational initiatives that provide learning opportunities for children and adults in need.',
                'video_id' => 'kJQP7kiw5Fk',
                'duration' => '6:45',
                'published_at' => Carbon::now()->subDays(15),
                'is_featured' => false,
                'sort_order' => 3,
                'tags' => ['education', 'programs', 'empowerment'],
                'status' => 'active',
            ],
            [
                'title' => 'Healthcare Initiatives - Caring for Our Community',
                'description' => 'Explore our healthcare programs that aim to improve access to medical services for vulnerable communities.',
                'video_id' => 'y6120QOlsfU',
                'duration' => '7:20',
                'published_at' => Carbon::now()->subDays(20),
                'is_featured' => false,
                'sort_order' => 4,
                'tags' => ['healthcare', 'medical', 'community'],
                'status' => 'active',
            ],
            [
                'title' => 'Fundraising Events - Supporting Our Mission',
                'description' => 'Highlights from our recent fundraising events and how your donations help us serve the community.',
                'video_id' => 'hFZFjoX2cGg',
                'duration' => '4:55',
                'published_at' => Carbon::now()->subDays(25),
                'is_featured' => false,
                'sort_order' => 5,
                'tags' => ['fundraising', 'events', 'donations'],
                'status' => 'active',
            ],
            [
                'title' => 'Community Development Projects - Building Together',
                'description' => 'See the progress of our community development projects and how they create lasting positive change.',
                'video_id' => 'jNQXAC9IVRw',
                'duration' => '9:10',
                'published_at' => Carbon::now()->subDays(30),
                'is_featured' => false,
                'sort_order' => 6,
                'tags' => ['development', 'projects', 'community'],
                'status' => 'active',
            ],
            [
                'title' => 'Success Stories - Transforming Lives',
                'description' => 'Real stories from people whose lives have been transformed through our programs and support.',
                'video_id' => 'ZZ5LpwO-An4',
                'duration' => '11:30',
                'published_at' => Carbon::now()->subDays(35),
                'is_featured' => true,
                'sort_order' => 7,
                'tags' => ['success', 'stories', 'transformation'],
                'status' => 'active',
            ],
            [
                'title' => 'Annual Report - Our Impact in Numbers',
                'description' => 'A comprehensive overview of our achievements, impact metrics, and plans for the future.',
                'video_id' => 'ZZ5LpwO-An5',
                'duration' => '15:45',
                'published_at' => Carbon::now()->subDays(40),
                'is_featured' => false,
                'sort_order' => 8,
                'tags' => ['report', 'impact', 'achievements'],
                'status' => 'active',
            ],
        ];

        foreach ($videos as $videoData) {
            YouTube::create($videoData);
        }
    }
}
