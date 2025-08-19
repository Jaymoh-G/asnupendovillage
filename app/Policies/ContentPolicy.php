<?php

namespace App\Policies;

use App\Models\User;

class ContentPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any content.
     */
    public function viewAny(User $user): bool
    {
        return $this->isEditorOrHigher($user);
    }

    /**
     * Determine whether the user can view content.
     */
    public function view(User $user): bool
    {
        return $this->isEditorOrHigher($user);
    }

    /**
     * Determine whether the user can create content.
     */
    public function create(User $user): bool
    {
        return $this->isEditorOrHigher($user);
    }

    /**
     * Determine whether the user can update content.
     */
    public function update(User $user): bool
    {
        return $this->isEditorOrHigher($user);
    }

    /**
     * Determine whether the user can delete content.
     */
    public function delete(User $user): bool
    {
        return $this->isAdminOrSuper($user);
    }

    /**
     * Determine whether the user can restore content.
     */
    public function restore(User $user): bool
    {
        return $this->isAdminOrSuper($user);
    }

    /**
     * Determine whether the user can permanently delete content.
     */
    public function forceDelete(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }
}
