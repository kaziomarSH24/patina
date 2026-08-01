<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'condition' => 'nullable|string|in:Excellent,Very Good,Good,Fair,Vintage',
            'case_size' => 'nullable|string|max:50',
            'year_of_production' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'accessories' => 'nullable|array',
            'condition_notes' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'brand_certificate' => 'nullable|file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
        ];
    }
}
