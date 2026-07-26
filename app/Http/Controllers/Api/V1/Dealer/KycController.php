<?php

namespace App\Http\Controllers\Api\V1\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\SubmitKycRequest;
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
     * Submit KYC documents.
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
     * Get the user's KYC status and documents.
     */
    public function status(Request $request)
    {
        $user = $request->user()->load('kycDocuments');
        
        return response_success('KYC status retrieved successfully.', new \App\Http\Resources\UserKycResource($user));
    }
}
