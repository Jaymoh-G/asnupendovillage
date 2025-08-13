<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoreValue;

class CoreValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coreValues = [
            [
                'title' => 'Compassion',
                'description' => 'We approach every individual with empathy, understanding, and a genuine desire to help those in need.',
                'icon' => 'fas fa-heart',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Integrity',
                'description' => 'We maintain the highest standards of honesty, transparency, and ethical behavior in all our actions.',
                'icon' => 'fas fa-shield-alt',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Excellence',
                'description' => 'We strive for the highest quality in everything we do, continuously improving our services and programs.',
                'icon' => 'fas fa-star',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Community',
                'description' => 'We believe in the power of community and work together to create lasting positive change.',
                'icon' => 'fas fa-users',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Innovation',
                'description' => 'We embrace new ideas and creative solutions to address the complex challenges facing our communities.',
                'icon' => 'fas fa-lightbulb',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Sustainability',
                'description' => 'We are committed to creating lasting impact and ensuring our programs continue to benefit future generations.',
                'icon' => 'fas fa-leaf',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($coreValues as $coreValue) {
            CoreValue::create($coreValue);
        }
    }
}
