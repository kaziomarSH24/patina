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
     */
    public function submitDocuments(User $user, array $validatedData, Request $request)
    {
        return DB::transaction(function () use ($user, $validatedData, $request) {
            
            $docType = $validatedData['document_type'];
            $frontFilePath = null;
            $backFilePath = null;
            $selfieFilePath = null;

            // Handle Front Side
            if ($request->hasFile('front_side')) {
                $frontFilePath = $this->handleFileUpload(
                    $request,
                    'front_side',
                    "kyc/{$user->id}",
                    null,
                    null,
                    90,
                    true // convert to webp
                );
            }

            // Handle Back Side (Optional based on doc type)
            if ($request->hasFile('back_side')) {
                $backFilePath = $this->handleFileUpload(
                    $request,
                    'back_side',
                    "kyc/{$user->id}",
                    null,
                    null,
                    90,
                    true
                );
            }

            // Handle Selfie
            if ($request->hasFile('selfie')) {
                $selfieFilePath = $this->handleFileUpload(
                    $request,
                    'selfie',
                    "kyc/{$user->id}",
                    null,
                    null,
                    90,
                    true
                );
            }

            if ($frontFilePath) {
                
                $status = 'pending';
                $rejectionReason = null;

                // Use Sandbox API for PAN
                if ($docType === 'pan') {
                    // Magic PAN for Testing Bypasses Sandbox
                    if ($validatedData['document_number'] === 'TESTPASS12' && config('app.env') === 'local') {
                        $panResult = ['success' => true];
                    } else {
                        $sandboxService = app(\App\Services\SandboxKycService::class);
                        $panResult = $sandboxService->verifyPan($validatedData['document_number'], $validatedData['legal_name']);
                    }
                    
                    if ($panResult['success']) {
                        $status = 'verified';
                    } else {
                        $status = 'rejected';
                        $errorMsg = $panResult['data']['message'] ?? json_encode($panResult['data'] ?? []);
                        $rejectionReason = 'Sandbox API Verification Failed: ' . $errorMsg;
                        \Illuminate\Support\Facades\Log::error("Sandbox Rejection Details: " . $errorMsg);
                    }
                } else {
                    // Call Mock Provider for other documents (like Aadhaar, Passport)
                    $verificationResponse = $this->kycProvider->verifyDocument([
                        'type' => $docType,
                        'file_path' => $frontFilePath,
                        'selfie_path' => $selfieFilePath, // Can be null
                        'user_id' => $user->id,
                        'legal_name' => $validatedData['legal_name'],
                        'document_number' => $validatedData['document_number']
                    ]);

                    if (isset($verificationResponse['result']['summary']['action'])) {
                        $action = $verificationResponse['result']['summary']['action'];
                        if ($action === 'pass') {
                            $status = 'verified';
                        } elseif ($action === 'fail') {
                            $status = 'rejected';
                            $rejectionReason = 'AI Verification Failed (Details or Face Mismatch)';
                        }
                    }
                }

                $documentData = [
                    'user_id' => $user->id,
                    'legal_name' => $validatedData['legal_name'],
                    'document_type' => $docType,
                    'document_number' => $validatedData['document_number'],
                    'dob' => $validatedData['dob'],
                    'city' => $validatedData['city'],
                    'file_path' => $frontFilePath,
                    'back_file_path' => $backFilePath,
                    'selfie_file_path' => $selfieFilePath,
                    'status' => $status,
                    'rejection_reason' => $rejectionReason
                ];

                $existingDoc = KycDocument::where('user_id', $user->id)
                    ->where('document_type', $docType)
                    ->first() ?? new KycDocument();

                $document = $this->storeOrUpdate($documentData, $existingDoc);

                // Update User Status
                $userStatus = 'submitted';
                if ($status === 'verified') {
                    $userStatus = 'approved';
                } elseif ($status === 'rejected') {
                    $userStatus = 'rejected';
                }

                $user->update([
                    'kyc_status' => $userStatus
                ]);

                return [$document];
            }

            throw new \Exception("Front side document is required.");
        });
    }

    public function approveUser(User $user)
    {
        return DB::transaction(function () use ($user) {
            $docs = $user->kycDocuments()->where('status', 'pending')->get();
            foreach ($docs as $doc) {
                $this->storeOrUpdate(['status' => 'verified'], $doc);
            }
            $user->update(['kyc_status' => 'approved']);
            return $user;
        });
    }

    public function rejectUser(User $user, string $reason)
    {
        return DB::transaction(function () use ($user, $reason) {
            $docs = $user->kycDocuments()->where('status', 'pending')->get();
            foreach ($docs as $doc) {
                $this->storeOrUpdate(['status' => 'rejected', 'rejection_reason' => $reason], $doc);
            }
            $user->update(['kyc_status' => 'rejected']);
            return $user;
        });
    }
}
