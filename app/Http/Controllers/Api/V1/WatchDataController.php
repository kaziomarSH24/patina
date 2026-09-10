<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\WatchApiService;

class WatchDataController extends Controller
{
    protected WatchApiService $watchApiService;

    public function __construct(WatchApiService $watchApiService)
    {
        $this->watchApiService = $watchApiService;
    }

    /**
     * Get a list of all watch brands for the dropdown.
     */
    public function brands(): JsonResponse
    {
        try {
            $brands = $this->watchApiService->getBrands();
            return response_success('Brands retrieved successfully', $brands);
        } catch (\Exception $e) {
            return response_error($e->getMessage(), [], 400);
        }
    }

    /**
     * Get a list of models for a specific brand for the dropdown.
     */
    public function models(Request $request): JsonResponse
    {
        $brand = $request->query('brand');
        
        if (empty($brand)) {
            return response_error('Brand parameter is required', [], 400);
        }

        try {
            $models = $this->watchApiService->getModels($brand);
            return response_success('Models retrieved successfully', $models);
        } catch (\Exception $e) {
            return response_error($e->getMessage(), [], 400);
        }
    }

    /**
     * Get a list of reference numbers for a specific brand for the dropdown.
     */
    public function references(Request $request): JsonResponse
    {
        $brand = $request->query('brand');
        
        if (empty($brand)) {
            return response_error('Brand parameter is required', [], 400);
        }

        try {
            $references = $this->watchApiService->getReferences($brand);
            return response_success('References retrieved successfully', $references);
        } catch (\Exception $e) {
            return response_error($e->getMessage(), [], 400);
        }
    }
}
