<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Http\Resources\SubscriptionPlanResource;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    /**
     * Get all active subscription plans
     */
    public function index()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();
        return response_success('Subscription plans retrieved successfully.', SubscriptionPlanResource::collection($plans));
    }
}
