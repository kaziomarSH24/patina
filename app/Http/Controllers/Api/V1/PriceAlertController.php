<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PriceAlert;
use App\Http\Requests\StorePriceAlertRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PriceAlertController extends Controller
{
    /**
     * Get all price alerts for the authenticated user.
     */
    public function index(): JsonResponse
    {
        $alerts = PriceAlert::where('user_id', Auth::id())->latest()->get();

        return response_success('Price alerts retrieved successfully.', $alerts);
    }

    /**
     * Create a new price alert.
     */
    public function store(StorePriceAlertRequest $request): JsonResponse
    {
        // Check if an alert already exists for this reference number
        $alert = PriceAlert::firstOrNew([
            'user_id' => Auth::id(),
            'reference_number' => $request->reference_number,
        ]);

        $alert->target_price = $request->target_price;
        $alert->is_active = true; // Always activate on creation/update
        $alert->save();

        return response_success('Price alert set successfully.', $alert, 201);
    }

    /**
     * Toggle the active status of an alert.
     */
    public function toggle($id): JsonResponse
    {
        $alert = PriceAlert::where('user_id', Auth::id())->findOrFail($id);
        
        $alert->is_active = !$alert->is_active;
        $alert->save();

        return response_success('Price alert toggled successfully.', $alert);
    }

    /**
     * Delete a price alert.
     */
    public function destroy($id): JsonResponse
    {
        $alert = PriceAlert::where('user_id', Auth::id())->findOrFail($id);
        $alert->delete();

        return response_success('Price alert deleted successfully.');
    }
}
