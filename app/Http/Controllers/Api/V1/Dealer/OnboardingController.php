<?php

namespace App\Http\Controllers\Api\V1\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\SubmitOnboardingRequest;
use App\Http\Resources\DealerProfileResource;
use App\Services\DealerOnboardingService;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    protected DealerOnboardingService $onboardingService;

    public function __construct(DealerOnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
    }

    /**
     * Submit Dealer Onboarding Application
     */
    public function submit(SubmitOnboardingRequest $request)
    {
        try {
            $profile = $this->onboardingService->submitApplication(
                $request->user(),
                $request->validated()
            );

            $profile->load('plan');

            return response_success(
                'Dealer application submitted successfully.',
                new DealerProfileResource($profile)
            );
        } catch (\Exception $e) {
            return response_error('Failed to submit application.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Get Dealer Onboarding Status
     */
    public function status(Request $request)
    {
        $profile = \App\Models\DealerProfile::where('user_id', $request->user()->id)->with('plan')->first();

        if (!$profile) {
            return response_success('No dealer application found.', null);
        }

        return response_success('Dealer application status retrieved successfully.', new DealerProfileResource($profile));
    }

    /**
     * Cancel/Delete Dealer Onboarding Application
     */
    public function cancel(Request $request)
    {
        $profile = \App\Models\DealerProfile::where('user_id', $request->user()->id)->first();

        if (!$profile) {
            return response_error('No application found to cancel.', [], 404);
        }

        $this->onboardingService->deleteApplication($profile);

        return response_success('Dealer application cancelled successfully.');
    }
}
