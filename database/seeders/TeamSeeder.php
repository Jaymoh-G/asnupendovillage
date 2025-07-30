<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Michel Connor',
                'position' => 'Volunteer Coordinator',
                'bio' => 'Michel has been coordinating volunteer activities for over 5 years, ensuring smooth operations and meaningful engagement.',
                'email' => 'michel.connor@example.com',
                'phone' => '+1234567890',
                'facebook' => 'https://facebook.com/michel.connor',
                'twitter' => 'https://twitter.com/michelconnor',
                'linkedin' => 'https://linkedin.com/in/michelconnor',
                'instagram' => 'https://instagram.com/michelconnor',
                'is_featured' => true,
                'sort_order' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Joseph Alexander',
                'position' => 'Community Outreach Specialist',
                'bio' => 'Joseph specializes in building relationships with local communities and developing outreach programs.',
                'email' => 'joseph.alexander@example.com',
                'phone' => '+1234567891',
                'facebook' => 'https://facebook.com/joseph.alexander',
                'twitter' => 'https://twitter.com/josephalexander',
                'linkedin' => 'https://linkedin.com/in/josephalexander',
                'instagram' => 'https://instagram.com/josephalexander',
                'is_featured' => true,
                'sort_order' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'Jessica Lauren',
                'position' => 'Program Director',
                'bio' => 'Jessica oversees program development and implementation, ensuring our initiatives meet community needs effectively.',
                'email' => 'jessica.lauren@example.com',
                'phone' => '+1234567892',
                'facebook' => 'https://facebook.com/jessica.lauren',
                'twitter' => 'https://twitter.com/jessicalauren',
                'linkedin' => 'https://linkedin.com/in/jessicalauren',
                'instagram' => 'https://instagram.com/jessicalauren',
                'is_featured' => true,
                'sort_order' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'Daniel Thomas',
                'position' => 'Fundraising Manager',
                'bio' => 'Daniel manages our fundraising efforts and donor relationships to ensure sustainable funding for our programs.',
                'email' => 'daniel.thomas@example.com',
                'phone' => '+1234567893',
                'facebook' => 'https://facebook.com/daniel.thomas',
                'twitter' => 'https://twitter.com/danielthomas',
                'linkedin' => 'https://linkedin.com/in/danielthomas',
                'instagram' => 'https://instagram.com/danielthomas',
                'is_featured' => true,
                'sort_order' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'Sarah Johnson',
                'position' => 'Education Coordinator',
                'bio' => 'Sarah coordinates our educational programs, ensuring children and adults have access to quality learning opportunities.',
                'email' => 'sarah.johnson@example.com',
                'phone' => '+1234567894',
                'facebook' => 'https://facebook.com/sarah.johnson',
                'twitter' => 'https://twitter.com/sarahjohnson',
                'linkedin' => 'https://linkedin.com/in/sarahjohnson',
                'instagram' => 'https://instagram.com/sarahjohnson',
                'is_featured' => false,
                'sort_order' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Michael Chen',
                'position' => 'Healthcare Coordinator',
                'bio' => 'Michael coordinates our healthcare initiatives, ensuring vulnerable communities have access to essential medical services.',
                'email' => 'michael.chen@example.com',
                'phone' => '+1234567895',
                'facebook' => 'https://facebook.com/michael.chen',
                'twitter' => 'https://twitter.com/michaelchen',
                'linkedin' => 'https://linkedin.com/in/michaelchen',
                'instagram' => 'https://instagram.com/michaelchen',
                'is_featured' => false,
                'sort_order' => 6,
                'status' => 'active',
            ],
        ];

        foreach ($teamMembers as $teamMemberData) {
            Team::firstOrCreate(
                ['name' => $teamMemberData['name']],
                $teamMemberData
            );
        }
    }
}
