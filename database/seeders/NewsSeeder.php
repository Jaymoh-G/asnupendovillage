<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsArticles = [
            [
                'title' => 'See Your Impact: Transparent Donation Tracking',
                'content' => '<p>We are excited to announce our new transparent donation tracking system that allows donors to see exactly how their contributions are making a difference in our community. This innovative platform provides real-time updates on project progress, fund allocation, and the direct impact of your generosity.</p><p>Through this system, you can track every dollar donated and see it transform into tangible improvements in the lives of those we serve. From educational programs to healthcare initiatives, your donations are creating lasting positive change.</p>',
                'excerpt' => 'Our new transparent donation tracking system allows donors to see exactly how their contributions are making a difference in our community.',
                'category' => 'Education',
                'author' => 'ASN Upendo Village Team',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
                'meta_title' => 'Transparent Donation Tracking - ASN Upendo Village',
                'meta_description' => 'See how your donations make a real impact with our new transparent tracking system.',
                'tags' => ['donations', 'transparency', 'impact'],
            ],
            [
                'title' => 'Every Contribution Counts: Make a Difference',
                'content' => '<p>Every donation, no matter how small, has the power to create meaningful change in our community. We believe that collective action, driven by individual generosity, can address the most pressing challenges facing vulnerable populations.</p><p>Your contributions support our comprehensive programs including education, healthcare, food security, and community development. Together, we are building a stronger, more resilient community where everyone has the opportunity to thrive.</p>',
                'excerpt' => 'Every donation, no matter how small, has the power to create meaningful change in our community.',
                'category' => 'Community',
                'author' => 'ASN Upendo Village Team',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(12),
                'meta_title' => 'Every Contribution Counts - ASN Upendo Village',
                'meta_description' => 'Learn how every donation makes a difference in our community programs.',
                'tags' => ['donations', 'community', 'impact'],
            ],
            [
                'title' => 'Real Stories, Real Impact: Your Donations at Work',
                'content' => '<p>Meet Sarah, a single mother of three who was struggling to provide for her family. Through our community support programs, Sarah received job training, childcare assistance, and emotional support. Today, she runs her own small business and is helping other families in similar situations.</p><p>This is just one of thousands of success stories made possible by your generous donations. Every story represents a life transformed, a family strengthened, and a community made better.</p>',
                'excerpt' => 'Meet the real people whose lives have been transformed by your generous donations and support.',
                'category' => 'Success Stories',
                'author' => 'ASN Upendo Village Team',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(18),
                'meta_title' => 'Real Stories, Real Impact - ASN Upendo Village',
                'meta_description' => 'Read inspiring stories of how your donations are transforming lives in our community.',
                'tags' => ['success stories', 'impact', 'community'],
            ],
            [
                'title' => 'New Educational Programs Launch This Month',
                'content' => '<p>We are thrilled to announce the launch of our expanded educational programs, designed to provide comprehensive support for children and adults in our community. These programs include after-school tutoring, adult literacy classes, vocational training, and digital skills development.</p><p>Education is the foundation of sustainable community development, and we are committed to ensuring that everyone has access to quality learning opportunities regardless of their circumstances.</p>',
                'excerpt' => 'Our expanded educational programs provide comprehensive support for children and adults in our community.',
                'category' => 'Education',
                'author' => 'ASN Upendo Village Team',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(25),
                'meta_title' => 'New Educational Programs - ASN Upendo Village',
                'meta_description' => 'Discover our new educational programs designed to support community development.',
                'tags' => ['education', 'programs', 'community'],
            ],
            [
                'title' => 'Volunteer Spotlight: Meet Our Dedicated Team',
                'content' => '<p>Our volunteers are the heart and soul of ASN Upendo Village. From organizing community events to providing direct support to families in need, our volunteers dedicate countless hours to making our community a better place.</p><p>This month, we want to highlight the incredible work of our volunteer team and share their inspiring stories of service and compassion. Their dedication reminds us that change happens one person, one family, one community at a time.</p>',
                'excerpt' => 'Meet the dedicated volunteers who are making a difference in our community every day.',
                'category' => 'Volunteers',
                'author' => 'ASN Upendo Village Team',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(32),
                'meta_title' => 'Volunteer Spotlight - ASN Upendo Village',
                'meta_description' => 'Meet our dedicated volunteers and learn about their inspiring work in the community.',
                'tags' => ['volunteers', 'community', 'service'],
            ],
            [
                'title' => 'Community Health Initiative: Improving Access to Care',
                'content' => '<p>Access to quality healthcare is a fundamental right that should be available to everyone. Our new community health initiative aims to bridge the gap in healthcare access by providing free health screenings, wellness education, and connecting families with healthcare providers.</p><p>This initiative is made possible through partnerships with local healthcare professionals and your generous donations. Together, we are working to ensure that no one in our community goes without essential healthcare services.</p>',
                'excerpt' => 'Our new community health initiative provides free health screenings and connects families with healthcare providers.',
                'category' => 'Healthcare',
                'author' => 'ASN Upendo Village Team',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(40),
                'meta_title' => 'Community Health Initiative - ASN Upendo Village',
                'meta_description' => 'Learn about our new community health initiative improving access to healthcare.',
                'tags' => ['healthcare', 'community', 'wellness'],
            ],
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
