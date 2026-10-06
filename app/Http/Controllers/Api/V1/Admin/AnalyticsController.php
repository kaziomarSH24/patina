<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminAnalyticsService;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends Controller
{
    protected $analyticsService;

    public function __construct(AdminAnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function index(): JsonResponse
    {
        $data = $this->analyticsService->getDashboardMetrics();
        return response_success('Analytics retrieved successfully', $data);
    }
}
