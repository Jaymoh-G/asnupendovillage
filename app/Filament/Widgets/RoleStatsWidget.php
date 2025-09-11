<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();

        $usersWithRoles = User::whereHas('roles')->count();
        $activeRoles = Role::whereHas('users')->count();

        return [
            Stat::make('Total Users', $totalUsers)
                ->description('Registered users in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Users with Roles', $usersWithRoles)
                ->description('Users assigned to roles')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('success'),

            Stat::make('Total Roles', $totalRoles)
                ->description('Available roles in the system')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('info'),

            Stat::make('Active Roles', $activeRoles)
                ->description('Roles currently assigned to users')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total Permissions', $totalPermissions)
                ->description('Available permissions in the system')
                ->descriptionIcon('heroicon-m-key')
                ->color('warning'),
        ];
    }
}
















