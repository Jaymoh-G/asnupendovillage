<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Check if user has any of the specified roles
     */
    protected function hasRole(User $user, $roles): bool
    {
        return $user->hasRole($roles);
    }

    /**
     * Check if user has any of the specified permissions
     */
    protected function hasPermission(User $user, $permissions): bool
    {
        return $user->hasAnyPermission($permissions);
    }

    /**
     * Check if user is Super Admin (has all permissions)
     */
    protected function isSuperAdmin(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Check if user is Admin or Super Admin
     */
    protected function isAdminOrSuper(User $user): bool
    {
        return $user->hasRole(['Admin', 'Super Admin']);
    }

    /**
     * Check if user is Editor, Admin, or Super Admin
     */
    protected function isEditorOrHigher(User $user): bool
    {
        return $user->hasRole(['Editor', 'Admin', 'Super Admin']);
    }
}
