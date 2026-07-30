<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RejectKycRequest;
use App\Models\User;
use App\Services\KycService;
use Illuminate\Http\Request;

class KycController extends Controller
{
    protected KycService $kycService;

    public function __construct(KycService $kycService)
    {
        $this->kycService = $kycService;
    }

    /**
     * Get a specific user's KYC documents.
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
     * List all pending KYCs.
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
     * Approve KYC.
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
     * Reject KYC.
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
