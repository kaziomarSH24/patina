<?php

namespace App\Services;

use App\Models\KycDocument;
use App\Models\User;
use App\Traits\FileUploadTrait;
use App\Contracts\KycProviderInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class KycService extends BaseService
{
    use FileUploadTrait;

    protected string $modelClass = KycDocument::class;
    
    protected KycProviderInterface $kycProvider;

    public function __construct(KycProviderInterface $kycProvider)
    {
        $this->kycProvider = $kycProvider;
    }

    protected function getAllowedFilters(): array
    {
        return ['status', 'document_type', 'user_id'];
    }

    protected function getAllowedIncludes(): array
    {
        return ['user'];
    }

    protected function getAllowedSorts(): array
    {
        return ['created_at', 'updated_at', 'status'];
    }

    /**
     * Submit KYC documents for a user.
     * Uses BaseService's storeOrUpdate method for database transactions.
     */
    public function submitDocuments(User $user, array $validatedData, Request $request)
    {
        return DB::transaction(function () use ($user, $validatedData, $request) {
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
                        // Call our Mock Hyperverge Provider to verify this specific document
                        $verificationResponse = $this->kycProvider->verifyDocument([
                            'type' => $type,
                            'file_path' => $filePath,
                            'user_id' => $user->id
                        ]);

                        // Determine initial status based on the mock provider's response
                        $status = 'pending';
                        if (isset($verificationResponse['result']['summary']['action'])) {
                            $action = $verificationResponse['result']['summary']['action'];
                            if ($action === 'pass') {
                                $status = 'verified'; // Auto-verify based on AI!
                            } elseif ($action === 'fail') {
                                $status = 'rejected';
                            }
                        }

                        // Use storeOrUpdate to insert/update data properly
                        $documentData = [
                            'user_id' => $user->id,
                            'document_type' => $type,
                            'file_path' => $filePath,
                            'status' => $status,
                            'rejection_reason' => $status === 'rejected' ? 'AI Verification Failed' : null
                        ];

                        // Find existing to update, or create new
                        $existingDoc = KycDocument::where('user_id', $user->id)
                            ->where('document_type', $type)
                            ->first();

                        $document = $this->storeOrUpdate($documentData, $existingDoc);
                        $uploadedDocuments[] = $document;
                    }
                }
            }

            // Update user status
            $allVerified = collect($uploadedDocuments)->every(fn($doc) => $doc->status === 'verified');
            
            $user->update([
                'kyc_status' => $allVerified ? 'approved' : 'submitted'
            ]);

            // If completely approved by AI, assign dealer role instantly
            if ($allVerified) {
                $role = Role::where('name', 'dealer')->where('guard_name', 'web')->first();
                if ($role && !$user->hasRole('dealer')) {
                    $user->assignRole($role);
                }
            }

            return $uploadedDocuments;
        });
    }

    /**
     * Approve KYC for a user and make them a dealer (Manual Admin Override)
     */
    public function approveUser(User $user, string $dealerTier = 'silver')
    {
        return DB::transaction(function () use ($user, $dealerTier) {
            // Update all pending docs to verified
            $docs = $user->kycDocuments()->where('status', 'pending')->get();
            foreach ($docs as $doc) {
                $this->storeOrUpdate(['status' => 'verified'], $doc);
            }

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
     * Reject KYC for a user (Manual Admin Override)
     */
    public function rejectUser(User $user, string $reason)
    {
        return DB::transaction(function () use ($user, $reason) {
            // Update all pending docs to rejected with reason
            $docs = $user->kycDocuments()->where('status', 'pending')->get();
            foreach ($docs as $doc) {
                $this->storeOrUpdate(['status' => 'rejected', 'rejection_reason' => $reason], $doc);
            }

            // Update user
            $user->update(['kyc_status' => 'rejected']);

            return $user;
        });
    }
}
