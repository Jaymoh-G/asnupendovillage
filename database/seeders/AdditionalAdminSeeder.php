<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdditionalAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the existing admin role
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Admin role not found. Please run AdminUserSeeder first.');
            return;
        }

        // Create additional admin user
        $additionalAdmin = User::firstOrCreate(
            ['email' => 'admin2@upendovillage.org'],
            [
                'name' => 'Admin Two',
                'password' => bcrypt('admin123'),
            ]
        );

        // Assign admin role to user
        $additionalAdmin->assignRole($adminRole);

        $this->command->info('Additional admin user created successfully!');
        $this->command->info('Email: admin2@upendovillage.org');
        $this->command->info('Password: admin123');
    }
}
