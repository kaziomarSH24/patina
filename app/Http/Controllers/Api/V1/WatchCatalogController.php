<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\WatchApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WatchCatalogController extends Controller
{
    protected WatchApiService $watchApiService;

    public function __construct(WatchApiService $watchApiService)
    {
        $this->watchApiService = $watchApiService;
    }

    /**
     * Search for watches via TheWatchAPI (Proxied & Cached)
     * 
     * GET /api/v1/watch-catalog/search?query=Rolex Daytona
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:2|max:100',
        ]);

        $query = $request->input('query');
        
        try {
            $results = $this->watchApiService->searchModels($query);

            return response_success('Watch catalog retrieved successfully', [
                'results' => $results,
            ]);
        } catch (\Exception $e) {
            return response_error($e->getMessage(), [], 400);
        }
    }
}
