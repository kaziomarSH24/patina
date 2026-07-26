<?php

namespace App\Services;

use App\Models\KycDocument;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class KycService
{
    use FileUploadTrait;

    /**
     * Submit KYC documents for a user.
     */
    public function submitDocuments(User $user, Request $request)
    {
        return DB::transaction(function () use ($user, $request) {
            $uploadedDocuments = [];
            $types = ['trade_license', 'nid_front', 'nid_back', 'passport', 'utility_bill'];

            foreach ($types as $type) {
                if ($request->hasFile($type)) {
                    $filePath = $this->handleFileUpload(
                        $request,
                        $type,
                        "kyc/{$user->id}",
                        null,
                        null,
                        90,
                        true // convert to webp for better storage
                    );

                    if ($filePath) {
                        $document = KycDocument::updateOrCreate(
                            ['user_id' => $user->id, 'document_type' => $type],
                            ['file_path' => $filePath, 'status' => 'pending', 'rejection_reason' => null]
                        );
                        $uploadedDocuments[] = $document;
                    }
                }
            }

            // Update user status
            $user->update(['kyc_status' => 'submitted']);

            return $uploadedDocuments;
        });
    }

    /**
     * Approve KYC for a user and make them a dealer.
     */
    public function approveUser(User $user, string $dealerTier = 'silver')
    {
        return DB::transaction(function () use ($user, $dealerTier) {
            // Update all pending docs to verified
            $user->kycDocuments()->where('status', 'pending')->update(['status' => 'verified']);

            // Update user
            $user->update([
                'kyc_status' => 'approved',
                'dealer_tier' => $dealerTier
            ]);

            // Assign dealer role
            $role = Role::where('name', 'dealer')->where('guard_name', 'web')->first();
            if ($role && !$user->hasRole('dealer')) {
                $user->assignRole($role);
            }

            return $user;
        });
    }

    /**
     * Reject KYC for a user.
     */
    public function rejectUser(User $user, string $reason)
    {
        return DB::transaction(function () use ($user, $reason) {
            // Update all pending docs to rejected with reason
            $user->kycDocuments()->where('status', 'pending')->update([
                'status' => 'rejected',
                'rejection_reason' => $reason
            ]);

            // Update user
            $user->update(['kyc_status' => 'rejected']);

            return $user;
        });
    }
}
