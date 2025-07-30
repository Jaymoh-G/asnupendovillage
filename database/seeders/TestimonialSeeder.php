<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\Program;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create some programs first
        $educationProgram = Program::firstOrCreate(
            ['title' => 'Education'],
            [
                'slug' => 'education',
                'content' => 'Our education programs focus on providing quality learning opportunities for children and adults.',
            ]
        );

        $healthProgram = Program::firstOrCreate(
            ['title' => 'Healthcare'],
            [
                'slug' => 'healthcare',
                'content' => 'Our healthcare initiatives aim to improve access to medical services for vulnerable communities.',
            ]
        );

        $communityProgram = Program::firstOrCreate(
            ['title' => 'Community Development'],
            [
                'slug' => 'community-development',
                'content' => 'We work to strengthen communities through various development initiatives.',
            ]
        );

        $testimonials = [
            [
                'name' => 'Alex Fernandes',
                'content' => 'Stay informed about our upcoming events and campaigns. Whether it\'s a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details. We prioritize your security. Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing.',
                'program_id' => $communityProgram->id,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Mustafa Kamal',
                'content' => 'Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing Stay informed about our upcoming events and campaigns. Whether it\'s a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details. We prioritize your security.',
                'program_id' => $educationProgram->id,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sarah Johnson',
                'content' => 'The impact of our community programs has been truly remarkable. I\'ve seen firsthand how the support and resources we provide can transform lives. The dedication of our volunteers and the generosity of our donors make all of this possible. Together, we\'re building a stronger, more compassionate community.',
                'program_id' => $healthProgram->id,
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Michael Chen',
                'content' => 'Working with ASN Upendo Village has been an incredible experience. The organization\'s commitment to transparency and accountability gives donors confidence that their contributions are making a real difference. The programs we run are designed to create lasting positive change in our community.',
                'program_id' => $educationProgram->id,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Fatima Al-Zahra',
                'content' => 'Our healthcare initiatives have reached thousands of families who otherwise wouldn\'t have access to essential medical services. The mobile clinics and health education programs are making a real difference in people\'s lives. It\'s inspiring to see the community come together to support these vital services.',
                'program_id' => $healthProgram->id,
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'David Rodriguez',
                'content' => 'Education is the foundation of sustainable community development. Our programs provide children and adults with the skills and knowledge they need to build better futures. The success stories we see every day motivate us to continue expanding our educational initiatives.',
                'program_id' => $educationProgram->id,
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Aisha Patel',
                'content' => 'The community development programs have created lasting positive change in our neighborhoods. From job training to housing assistance, we\'re addressing the root causes of poverty and helping families build sustainable futures. The collaborative approach with local partners ensures our programs are effective and culturally appropriate.',
                'program_id' => $communityProgram->id,
                'is_featured' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::firstOrCreate(
                ['name' => $testimonialData['name']],
                $testimonialData
            );
        }
    }
}
