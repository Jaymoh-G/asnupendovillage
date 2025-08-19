<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:manage {action} {--user=} {--role=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage user roles and permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $userEmail = $this->option('user');
        $roleName = $this->option('role');

        switch ($action) {
            case 'list':
                $this->listRoles();
                break;
            case 'assign':
                $this->assignRole($userEmail, $roleName);
                break;
            case 'remove':
                $this->removeRole($userEmail, $roleName);
                break;
            case 'users':
                $this->listUsers();
                break;
            default:
                $this->error('Invalid action. Use: list, assign, remove, or users');
                return 1;
        }

        return 0;
    }

    /**
     * List all available roles
     */
    private function listRoles(): void
    {
        $this->info('Available Roles:');
        $this->line('');

        $roles = Role::with('permissions')->get();

        foreach ($roles as $role) {
            $this->line("📋 <fg=yellow>{$role->name}</fg=yellow>");
            $this->line("   Permissions: " . $role->permissions->pluck('name')->implode(', '));
            $this->line('');
        }
    }

    /**
     * List all users with their roles
     */
    private function listUsers(): void
    {
        $this->info('Users and Their Roles:');
        $this->line('');

        $users = User::with('roles')->get();

        foreach ($users as $user) {
            $roles = $user->roles->pluck('name')->implode(', ');
            $roles = $roles ?: 'No roles assigned';

            $this->line("👤 <fg=green>{$user->name}</fg=green> ({$user->email})");
            $this->line("   Roles: {$roles}");
            $this->line('');
        }
    }

    /**
     * Assign a role to a user
     */
    private function assignRole(string $userEmail, string $roleName): void
    {
        if (!$userEmail || !$roleName) {
            $this->error('Both --user and --role options are required for assignment');
            return;
        }

        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            $this->error("User with email '{$userEmail}' not found");
            return;
        }

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Role '{$roleName}' not found");
            return;
        }

        $user->assignRole($role);
        $this->info("✅ Role '{$roleName}' assigned to user '{$user->name}' successfully!");
    }

    /**
     * Remove a role from a user
     */
    private function removeRole(string $userEmail, string $roleName): void
    {
        if (!$userEmail || !$roleName) {
            $this->error('Both --user and --role options are required for removal');
            return;
        }

        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            $this->error("User with email '{$userEmail}' not found");
            return;
        }

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Role '{$roleName}' not found");
            return;
        }

        $user->removeRole($role);
        $this->info("✅ Role '{$roleName}' removed from user '{$user->name}' successfully!");
    }
}
