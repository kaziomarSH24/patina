<?php

namespace App\Http\Controllers\Api\V1\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\SubmitKycRequest;
use App\Services\KycService;
use Illuminate\Http\Request;

/**
 * @group User & Dealer KYC
 *
 * APIs for users and dealers to submit their KYC documents and check their status.
 */
class KycController extends Controller
{
    protected KycService $kycService;

    public function __construct(KycService $kycService)
    {
        $this->kycService = $kycService;
    }

    /**
     * Submit KYC
     *
     * Submit KYC documents for verification.
     *
     * @bodyParam id_front file required The front side of the ID card.
     * @bodyParam id_back file required The back side of the ID card.
     * @bodyParam selfie file required A selfie of the user holding the ID.
     */
    public function submit(SubmitKycRequest $request)
    {
        $user = $request->user();

        if ($user->kyc_status === 'approved') {
            return response_error('Your KYC is already approved.', [], 400);
        }

        if ($user->kyc_status === 'submitted') {
            return response_error('Your KYC is already under review.', [], 400);
        }

        try {
            $documents = $this->kycService->submitDocuments($user, $request);
            return response_success('KYC documents submitted successfully.', $documents, 201);
        } catch (\Exception $e) {
            return response_error('Failed to submit KYC documents.', ['trace' => $e->getMessage()], 500);
        }
    }

    /**
     * Check KYC Status
     *
     * Get the authenticated user's current KYC status and submitted documents.
     *
     * @apiResource App\Http\Resources\UserKycResource
     * @apiResourceModel App\Models\User
     */
    public function status(Request $request)
    {
        $user = $request->user()->load('kycDocuments');
        
        return response_success('KYC status retrieved successfully.', new \App\Http\Resources\UserKycResource($user));
    }
}
