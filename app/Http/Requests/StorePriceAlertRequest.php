<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StorePriceAlertRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true; // Any authenticated user can set a price alert
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reference_number' => 'required|string|max:255',
            'target_price' => 'required|numeric|min:1',
        ];
    }
}
