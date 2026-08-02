<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class UpdateListingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'condition' => 'nullable|string|max:255',
            'case_size' => 'nullable|string|max:255',
            'year_of_production' => 'nullable|string|max:4',
            'location' => 'nullable|string|max:255',
            'accessories' => 'nullable|array',
            'condition_notes' => 'nullable|string',
        ];
    }
}

