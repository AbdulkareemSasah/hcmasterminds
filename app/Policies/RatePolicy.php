<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Rate;
use App\Models\User;

class RatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Rate');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rate $rate): bool
    {
        return $user->checkPermissionTo('view Rate');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Rate');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rate $rate): bool
    {
        return $user->checkPermissionTo('update Rate');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rate $rate): bool
    {
        return $user->checkPermissionTo('delete Rate');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rate $rate): bool
    {
        return $user->checkPermissionTo('restore Rate');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rate $rate): bool
    {
        return $user->checkPermissionTo('force-delete Rate');
    }
}
