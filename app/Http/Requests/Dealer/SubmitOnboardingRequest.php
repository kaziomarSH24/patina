<?php

namespace App\Http\Requests\Dealer;

use App\Http\Requests\BaseRequest;

class SubmitOnboardingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'business_name' => 'required|string|max:255',
            'address' => 'required|string',
            'approx_monthly_inventory' => 'nullable|string|max:255',
            'website_link' => 'nullable|url|max:255',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'gst_certificate' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }
}
