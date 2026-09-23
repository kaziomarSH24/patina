<?php

namespace App\Services;

use App\Models\DealerProfile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class DealerOnboardingService extends BaseService
{
    use \App\Traits\FileUploadTrait;

    protected string $modelClass = DealerProfile::class;

    protected function getAllowedFilters(): array
    {
        return [];
    }

    protected function getAllowedIncludes(): array
    {
        return ['user', 'plan'];
    }

    protected function getAllowedSorts(): array
    {
        return ['created_at', 'status'];
    }

    /**
     * Submit or update dealer onboarding application
     *
     * @param User $user
     * @param array $data
     * @return DealerProfile
     * @throws Exception
     */
    public function submitApplication(User $user, array $data): DealerProfile
    {
        // 1. Verify PAN (Pass user's registered name to match)
        $kycService = app(\App\Services\SandboxKycService::class);
        $panResult = $kycService->verifyPan($data['pan_number'], $user->name);
        
        if (!$panResult['success']) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'pan_number' => ['PAN verification failed or Name on PAN does not match your registered account name.']
            ]);
        }

        // 2. Verify Bank Account (Pass user's registered name to match)
        $bankResult = $kycService->verifyBankAccount($data['bank_account_number'], $data['bank_ifsc'], $user->name);
        if (!$bankResult['success']) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'bank_account_number' => ['Bank account verification failed or Account Holder Name does not match.']
            ]);
        }
        
        // Extract exact beneficiary name from bank response if available
        $data['bank_beneficiary_name'] = $bankResult['data']['data']['name_at_bank'] ?? $user->name;

        // 3. Mark User KYC as approved automatically
        $user->kyc_status = 'approved';
        $user->save();

        $existingProfile = DealerProfile::where('user_id', $user->id)->first() ?? new DealerProfile();

        // Handle GST certificate upload if provided
        if (isset($data['gst_certificate']) && $data['gst_certificate'] instanceof UploadedFile) {
            // Delete old file if exists
            if ($existingProfile->gst_certificate_path) {
                $this->deleteFile($existingProfile->gst_certificate_path);
            }
            $path = $data['gst_certificate']->store('dealer_documents/' . $user->id, 'public');
            $data['gst_certificate_path'] = $path;
        }
        unset($data['gst_certificate']); // Remove so it doesn't try to bulk-assign the file object
        
        $data['user_id'] = $user->id;
        
        // If not already approved, set status to pending review
        if ($existingProfile->status !== 'approved') {
            $data['status'] = 'pending';
        }

        return $this->storeOrUpdate($data, $existingProfile);
    }

    /**
     * Delete a dealer onboarding application and its associated files
     */
    public function deleteApplication(DealerProfile $profile): bool
    {
        if ($profile->gst_certificate_path) {
            $this->deleteFile($profile->gst_certificate_path);
        }
        return $profile->delete();
    }
}
