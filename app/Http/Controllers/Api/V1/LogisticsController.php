<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\BlueDartService;
use Illuminate\Http\Request;

class LogisticsController extends Controller
{
    protected BlueDartService $blueDartService;

    public function __construct(BlueDartService $blueDartService)
    {
        $this->blueDartService = $blueDartService;
    }

    /**
     * Check Pincode Serviceability
     */
    public function checkPincode(Request $request, $pincode)
    {
        if (empty($pincode) || strlen($pincode) !== 6) {
            return response_error('Invalid pincode provided. Must be 6 digits.', [], 400);
        }

        $isDeliverable = $this->blueDartService->checkServiceability($pincode);

        if ($isDeliverable) {
            return response_success('Service available at this pincode.');
        }

        return response_error('Delivery service not available at this pincode.', [], 400);
    }
}
