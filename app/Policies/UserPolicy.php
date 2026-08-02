<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the account standing.
     */
    public function updateStanding(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can manage KYC verification.
     */
    public function manageKyc(User $user): bool
    {
        return $user->hasRole('admin');
    }
}
