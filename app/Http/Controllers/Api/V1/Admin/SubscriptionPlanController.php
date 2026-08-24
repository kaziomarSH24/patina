<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Http\Requests\Admin\StoreSubscriptionPlanRequest;
use App\Http\Requests\Admin\UpdateSubscriptionPlanRequest;
use App\Http\Resources\SubscriptionPlanResource;
use Illuminate\Support\Str;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::all();
        return response_success('Plans retrieved successfully', SubscriptionPlanResource::collection($plans));
    }

    public function store(StoreSubscriptionPlanRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        
        $plan = SubscriptionPlan::create($data);
        return response_success('Plan created successfully', new SubscriptionPlanResource($plan));
    }

    public function show(SubscriptionPlan $subscriptionPlan)
    {
        return response_success('Plan retrieved successfully', new SubscriptionPlanResource($subscriptionPlan));
    }

    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        $data = $request->validated();
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $subscriptionPlan->update($data);
        return response_success('Plan updated successfully', new SubscriptionPlanResource($subscriptionPlan));
    }

    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();
        return response_success('Plan deleted successfully');
    }
}
