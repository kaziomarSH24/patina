<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::role('dealer')->with(['dealerProfile.plan'])->withCount('listings');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('dealerProfile', function($q2) use ($search) {
                      $q2->where('business_name', 'like', "%{$search}%");
                  });
            });
        }

        $dealers = $query->paginate(15);

        $mapped = $dealers->getCollection()->map(function ($user) {
            $profile = $user->dealerProfile;
            $plan = $profile ? $profile->plan : null;
            
            return [
                'id' => $user->id,
                'business' => $profile ? $profile->business_name : $user->name,
                'owner' => $user->name,
                'since' => $profile ? $profile->created_at->format('Y') : $user->created_at->format('Y'),
                'tier' => $plan ? $plan->name : 'N/A',
                'kyc' => ucfirst($user->kyc_status ?? 'pending'),
                // Real usage from user's active listings
                'creditUsage' => $user->listings_count ?? 0, 
                'creditLimit' => $plan ? $plan->listing_limit : 0,
                'subscription' => $profile && $profile->status === 'approved' ? 'Active' : 'Pending',
            ];
        });

        $dealers->setCollection($mapped);

        return response_success('Active dealers retrieved successfully', $dealers->toArray());
    }
}
