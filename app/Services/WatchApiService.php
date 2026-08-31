<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WatchApiService
{
    protected string $baseUrl;
    protected string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.watch_api.base_url', 'https://api.thewatchapi.com/v1');
        $this->token = config('services.watch_api.token');
    }

    /**
     * Search for watch models using TheWatchAPI with 48 hours Redis Caching.
     * 
     * @param string $query
     * @return array
     */
    public function searchModels(string $query): array
    {
        if (empty($this->token)) {
            // Failsafe for development if token is missing
            return [];
        }

        // Cache key based on the sanitized search query
        $cacheKey = 'watch_api_search_' . md5(strtolower(trim($query)));

        // 48 hours cache (in seconds)
        return Cache::remember($cacheKey, 172800, function () use ($query) {
            
            $response = Http::get("{$this->baseUrl}/model/search", [
                'api_token' => $this->token,
                'search' => $query,
                'search_attributes' => 'brand,model,reference_number',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            // Throw exception with the exact API error message so frontend knows
            $errorData = $response->json();
            $errorMessage = $errorData['error']['message'] ?? 'Failed to fetch from TheWatchAPI';
            throw new \Exception($errorMessage);
        });
    }

    /**
     * Clear cache for a specific query (Admin Utility)
     */
    public function clearSearchCache(string $query): void
    {
        $cacheKey = 'watch_api_search_' . md5(strtolower(trim($query)));
        Cache::forget($cacheKey);
    }
}
