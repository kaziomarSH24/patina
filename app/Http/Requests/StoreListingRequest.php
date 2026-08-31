<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->kyc_status === 'approved';
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('You must complete KYC verification before you can create a listing.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sale_method' => 'nullable|string|in:marketplace,direct_sale',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|string|in:Excellent,Very Good,Good,Fair,Vintage',
            'case_size' => 'nullable|string|max:50',
            'year_of_production' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'accessories' => 'nullable|array',
            'condition_notes' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'brand_certificate' => 'nullable|file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            
            // Payment fields (Required for non-dealers)
            'razorpay_payment_id' => 'required_unless:is_dealer,true|string',
            'razorpay_order_id' => 'required_unless:is_dealer,true|string',
            'razorpay_signature' => 'required_unless:is_dealer,true|string',
        ];
    }

    protected function prepareForValidation()
    {
        // Add a helper field to easily validate if the user is a dealer
        $this->merge([
            'is_dealer' => $this->user() && $this->user()->hasRole('dealer') ? 'true' : 'false',
        ]);
    }
}
