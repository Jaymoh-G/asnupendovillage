<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Healthy Foods',
                'content' => 'Our Healthy Foods program provides nutritious meals and food assistance to families in need. We work with local farmers and food banks to ensure access to fresh, healthy food options for vulnerable communities.',
                'meta_title' => 'Healthy Foods Program - ASN Upendo Village',
                'meta_description' => 'Providing nutritious meals and food assistance to families in need through our Healthy Foods program.',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Education',
                'content' => 'Our Education program focuses on providing quality learning opportunities for children and adults. We offer scholarships, school supplies, and educational resources to help students succeed academically.',
                'meta_title' => 'Education Program - ASN Upendo Village',
                'meta_description' => 'Providing quality education opportunities and resources to help students succeed academically.',
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Medical Help',
                'content' => 'Our Medical Help program ensures access to essential healthcare services for vulnerable communities. We provide medical check-ups, medications, and health education to improve community health outcomes.',
                'meta_title' => 'Medical Help Program - ASN Upendo Village',
                'meta_description' => 'Ensuring access to essential healthcare services and medical assistance for vulnerable communities.',
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Community Development',
                'content' => 'Our Community Development program works to strengthen communities through various initiatives including infrastructure projects, skills training, and economic empowerment programs.',
                'meta_title' => 'Community Development Program - ASN Upendo Village',
                'meta_description' => 'Strengthening communities through infrastructure projects, skills training, and economic empowerment.',
                'featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Housing Assistance',
                'content' => 'Our Housing Assistance program helps families find safe and affordable housing. We provide support with rent, home repairs, and emergency shelter for those in need.',
                'meta_title' => 'Housing Assistance Program - ASN Upendo Village',
                'meta_description' => 'Helping families find safe and affordable housing through our comprehensive assistance program.',
                'featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Youth Empowerment',
                'content' => 'Our Youth Empowerment program focuses on developing leadership skills, providing mentorship, and creating opportunities for young people to become active community leaders.',
                'meta_title' => 'Youth Empowerment Program - ASN Upendo Village',
                'meta_description' => 'Developing leadership skills and creating opportunities for young people to become community leaders.',
                'featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'Emergency Relief',
                'content' => 'Our Emergency Relief program provides immediate assistance during crises and natural disasters. We offer emergency food, shelter, and medical care to affected communities.',
                'meta_title' => 'Emergency Relief Program - ASN Upendo Village',
                'meta_description' => 'Providing immediate assistance during crises and natural disasters to affected communities.',
                'featured' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($programs as $programData) {
            Program::firstOrCreate(
                ['title' => $programData['title']],
                $programData
            );
        }
    }
}
