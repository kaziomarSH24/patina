<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealerProfile;
use App\Http\Resources\DealerProfileResource;
use App\Http\Requests\Admin\UpdateDealerApplicationStatusRequest;
use Illuminate\Http\Request;

class DealerApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = DealerProfile::with(['user', 'plan']);
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $applications = $query->paginate(15);
        
        return response_success('Dealer applications retrieved successfully', 
            DealerProfileResource::collection($applications)->response()->getData(true)
        );
    }

    public function show($id)
    {
        $application = DealerProfile::with(['user', 'plan'])->findOrFail($id);
        return response_success('Application retrieved successfully', new DealerProfileResource($application));
    }

    public function updateStatus(UpdateDealerApplicationStatusRequest $request, $id)
    {
        $application = DealerProfile::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        // Manage user roles based on application status
        $user = $application->user;
        if ($request->status === 'approved') {
            $user->syncRoles(['dealer']);
        } elseif (in_array($request->status, ['rejected', 'pending'])) {
            // Downgrade to customer if their application is rejected or moved back to pending
            $user->syncRoles(['customer']);
        }

        return response_success('Application status updated successfully', new DealerProfileResource($application));
    }

    public function destroy($id)
    {
        $application = DealerProfile::findOrFail($id);
        
        $service = app(\App\Services\DealerOnboardingService::class);
        $service->deleteApplication($application);

        return response_success('Application deleted successfully');
    }
}
