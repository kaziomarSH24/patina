<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminNotificationService;
use Illuminate\Http\JsonResponse;

class AdminNotificationController extends Controller
{
    protected AdminNotificationService $notificationService;

    public function __construct(AdminNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function criticalAlerts(): JsonResponse
    {
        $alerts = $this->notificationService->getCriticalAlerts();
        return response()->json(['data' => $alerts]);
    }
}
