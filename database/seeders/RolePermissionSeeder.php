<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions for different modules
        $permissions = [
            // Content Management
            'view_content',
            'create_content',
            'edit_content',
            'delete_content',

            // Media Management
            'view_media',
            'create_media',
            'edit_media',
            'delete_media',

            // User Management
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',

            // Role Management
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',

            // Settings Management
            'view_settings',
            'edit_settings',

            // Donation Management
            'view_donations',
            'edit_donations',
            'delete_donations',

            // System Administration
            'access_filament',
            'manage_system',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles with different permission levels
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

        // Assign permissions to Editor role
        $editorRole->givePermissionTo([
            'view_content',
            'create_content',
            'edit_content',
            'view_media',
            'create_media',
            'edit_media',
            'view_donations',
            'access_filament',
        ]);

        // Assign permissions to Admin role
        $adminRole->givePermissionTo([
            'view_content',
            'create_content',
            'edit_content',
            'delete_content',
            'view_media',
            'create_media',
            'edit_media',
            'delete_media',
            'view_users',
            'edit_users',
            'view_settings',
            'edit_settings',
            'view_donations',
            'edit_donations',
            'access_filament',
        ]);

        // Assign permissions to Super Admin role (all permissions)
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign Super Admin role to existing admin user
        $adminUser = User::where('email', 'admin@gmail.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('Super Admin');
            $this->command->info('Super Admin role assigned to admin@gmail.com');
        }

        // Create additional users for testing (optional)
        $this->createTestUsers();

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Roles: Editor, Admin, Super Admin');
        $this->command->info('Super Admin role assigned to admin@gmail.com');
    }

    /**
     * Create test users for different roles
     */
    private function createTestUsers(): void
    {
        // Create Editor user
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Content Editor',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $editor->assignRole('Editor');

        // Create Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        $this->command->info('Test users created:');
        $this->command->info('- editor@example.com (Editor role)');
        $this->command->info('- admin@example.com (Admin role)');
        $this->command->info('Password for test users: password');
    }
}
