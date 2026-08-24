<?php

namespace App\Http\Requests\Dealer;

use App\Http\Requests\BaseRequest;

class SubmitKycRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'legal_name' => 'required|string|max:255',
            'document_type' => 'required|in:aadhaar,pan,passport',
            'document_number' => 'required|string|max:50',
            'dob' => 'required|date|before:today',
            'city' => 'required|string|max:100',
            
            // Files
            'front_side' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'back_side' => 'required_if:document_type,aadhaar|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'selfie' => 'required|file|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
