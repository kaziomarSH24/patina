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
     * Get price history for a specific reference number from TheWatchAPI
     * 
     * @param string $reference
     * @return array
     */
    public function getPriceHistory(string $reference): array
    {
        if (empty($this->token)) {
            return [];
        }

        // Cache historical prices for 24 hours to save API calls
        $cacheKey = 'watch_api_history_' . md5(strtolower(trim($reference)));

        return Cache::remember($cacheKey, 86400, function () use ($reference) {
            $response = Http::get("{$this->baseUrl}/reference/price/history", [
                'api_token' => $this->token,
                'reference_number' => $reference,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            $errorData = $response->json();
            $errorMessage = $errorData['error']['message'] ?? 'Failed to fetch price history from TheWatchAPI';
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

    /**
     * Get list of all brands (Cached for 7 days)
     */
    public function getBrands(): array
    {
        return Cache::remember('watch_api_brand_list', 604800, function () {
            $response = Http::get("{$this->baseUrl}/brand/list", [
                'api_token' => $this->token,
            ]);

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            }
            throw new \Exception($response->json()['error']['message'] ?? 'Failed to fetch brands');
        });
    }

    /**
     * Get list of models for a specific brand (Cached for 7 days)
     */
    public function getModels(string $brand): array
    {
        $cacheKey = 'watch_api_model_list_' . md5(strtolower(trim($brand)));
        
        return Cache::remember($cacheKey, 604800, function () use ($brand) {
            $response = Http::get("{$this->baseUrl}/model/list", [
                'api_token' => $this->token,
                'brand' => $brand,
            ]);

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            }
            throw new \Exception($response->json()['error']['message'] ?? 'Failed to fetch models');
        });
    }

    /**
     * Get list of reference numbers for a specific brand (Cached for 7 days)
     */
    public function getReferences(string $brand): array
    {
        $cacheKey = 'watch_api_reference_list_' . md5(strtolower(trim($brand)));
        
        return Cache::remember($cacheKey, 604800, function () use ($brand) {
            $response = Http::get("{$this->baseUrl}/reference/list", [
                'api_token' => $this->token,
                'brand' => $brand,
            ]);

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            }
            throw new \Exception($response->json()['error']['message'] ?? 'Failed to fetch references');
        });
    }
}
