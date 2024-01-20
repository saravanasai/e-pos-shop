<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user,User $authUser): bool
    {

        return $authUser->hasRole(['admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,User $authUser): bool
    {
        return $authUser->hasRole(['admin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user,User $authUser): bool
    {
        return $authUser->hasRole(['admin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,User $authUser): bool
    {
        return $authUser->hasRole(['admin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user,User $authUser): bool
    {
        return $authUser->hasRole(['admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user,User $authUser): bool
    {
        return $authUser->hasRole(['admin']);
    }
}
