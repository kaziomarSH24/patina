<?php

namespace App\Policies;

use App\Models\KycDocument;
use App\Models\User;

class KycDocumentPolicy
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
    public function view(User $user, KycDocument $kycDocument): bool
    {
        return $user->id === $kycDocument->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Users can only submit KYC if they haven't been approved or haven't maxed out attempts
        return $user->kyc_status !== 'approved';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KycDocument $kycDocument): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KycDocument $kycDocument): bool
    {
        return $user->hasRole('admin');
    }
}
