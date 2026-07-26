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
            'trade_license' => 'required_without_all:nid_front,nid_back,passport,utility_bill|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'nid_front' => 'required_without_all:trade_license,passport,utility_bill|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'nid_back' => 'required_with:nid_front|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'passport' => 'sometimes|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'utility_bill' => 'sometimes|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ];
    }
}
