<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RejectKycRequest;
use App\Models\User;
use App\Services\KycService;
use Illuminate\Http\Request;

/**
 * @group Admin KYC Management
 *
 * APIs for admins to review and approve/reject user KYC applications.
 */
class KycController extends Controller
{
    protected KycService $kycService;

    public function __construct(KycService $kycService)
    {
        $this->kycService = $kycService;
    }

    /**
     * Get user KYC documents
     *
     * Get a specific user's submitted KYC documents.
     *
     * @urlParam userId string required The ID of the user. Example: 1
     */
    public function documents(string $userId)
    {
        $user = User::with('kycDocuments')->findOrFail($userId);

        return response_success('User KYC documents retrieved successfully.', [
            'kyc_status' => $user->kyc_status,
            'documents' => $user->kycDocuments,
        ]);
    }

    /**
     * List pending KYCs
     *
     * List all users who have submitted KYC and are waiting for approval.
     */
    public function pending(Request $request)
    {
        $users = User::where('kyc_status', 'submitted')
            ->with(['kycDocuments' => function($q) {
                $q->where('status', 'pending');
            }])
            ->paginate(15);
            
        return response_success(
            'Pending KYC applications retrieved successfully.', 
            \App\Http\Resources\UserKycResource::collection($users)->response()->getData(true)
        );
    }

    /**
     * Approve KYC
     *
     * Approve a user's KYC submission and upgrade them to a dealer role.
     *
     * @urlParam userId string required The ID of the user. Example: 1
     */
    public function approve(Request $request, string $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->kyc_status !== 'submitted') {
            return response_error('User KYC is not in submitted state.', [], 400);
        }

        try {
            $this->kycService->approveUser($user);
            return response_success('User KYC approved and dealer role assigned successfully.');
        } catch (\Exception $e) {
            return response_error('Failed to approve KYC.', ['trace' => $e->getMessage()], 500);
        }
    }

    /**
     * Reject KYC
     *
     * Reject a user's KYC submission and provide a reason.
     *
     * @urlParam userId string required The ID of the user. Example: 1
     */
    public function reject(RejectKycRequest $request, string $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->kyc_status !== 'submitted') {
            return response_error('User KYC is not in submitted state.', [], 400);
        }

        try {
            $this->kycService->rejectUser($user, $request->reason);
            return response_success('User KYC rejected successfully.');
        } catch (\Exception $e) {
            return response_error('Failed to reject KYC.', ['trace' => $e->getMessage()], 500);
        }
    }
}
