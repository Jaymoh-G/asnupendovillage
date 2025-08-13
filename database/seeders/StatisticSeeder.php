<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistics = [
            [
                'title' => 'People Helped',
                'value' => 15000,
                'suffix' => '+',
                'icon' => 'fas fa-users',
                'description' => 'Individuals and families supported through our programs',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Projects Completed',
                'value' => 250,
                'suffix' => '+',
                'icon' => 'fas fa-project-diagram',
                'description' => 'Successful community development projects',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Volunteers',
                'value' => 500,
                'suffix' => '+',
                'icon' => 'fas fa-hands-helping',
                'description' => 'Dedicated volunteers supporting our mission',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Years of Service',
                'value' => 25,
                'suffix' => '+',
                'icon' => 'fas fa-calendar-alt',
                'description' => 'Decades of commitment to community service',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Communities Served',
                'value' => 50,
                'suffix' => '+',
                'icon' => 'fas fa-map-marker-alt',
                'description' => 'Communities across the region',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Success Rate',
                'value' => 95,
                'suffix' => '%',
                'icon' => 'fas fa-chart-line',
                'description' => 'Program success and impact rate',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($statistics as $statistic) {
            Statistic::create($statistic);
        }
    }
}
