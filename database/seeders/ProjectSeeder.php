<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
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

        $projects = [
            [
                'name' => 'Compassion Connect',
                'description' => 'A comprehensive community outreach program that connects volunteers with families in need, providing essential services and support.',
                'program_id' => $communityProgram->id,
                'status' => 'active',
            ],
            [
                'name' => 'Child Education Initiative',
                'description' => 'Providing quality education and learning resources to children from disadvantaged backgrounds, ensuring they have the tools to succeed.',
                'program_id' => $educationProgram->id,
                'status' => 'active',
            ],
            [
                'name' => 'Nurturing Health',
                'description' => 'Improving access to healthcare services and promoting wellness in underserved communities through mobile clinics and health education.',
                'program_id' => $healthProgram->id,
                'status' => 'active',
            ],
            [
                'name' => 'Digital Literacy Program',
                'description' => 'Teaching essential computer and digital skills to help community members access online resources and improve their employment prospects.',
                'program_id' => $educationProgram->id,
                'status' => 'active',
            ],
            [
                'name' => 'Food Security Project',
                'description' => 'Establishing community gardens and food distribution programs to address hunger and promote sustainable food practices.',
                'program_id' => $communityProgram->id,
                'status' => 'active',
            ],
        ];

        foreach ($projects as $projectData) {
            Project::firstOrCreate(
                ['name' => $projectData['name']],
                $projectData
            );
        }
    }
}
