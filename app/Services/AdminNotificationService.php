<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\EscrowTransaction;
use Carbon\Carbon;

class AdminNotificationService
{
    public function getCriticalAlerts(): array
    {
        $alerts = [];
        $now = Carbon::now();

        // 1. Photo reviews approaching SLA (Under Review for > 20 hours)
        $pendingReviews = Listing::where('status', 'Under Review')
            ->where('created_at', '<=', $now->copy()->subHours(20))
            ->get();
            
        if ($pendingReviews->count() > 0) {
            $ids = $pendingReviews->take(2)->pluck('id')->map(fn($id) => 'PAT-'.$id)->implode(' and ');
            $suffix = $pendingReviews->count() > 2 ? ' and others' : '';
            
            $alerts[] = [
                'type' => 'warning',
                'title' => $pendingReviews->count() . ' photo reviews approaching 24h SLA',
                'detail' => $ids . $suffix . ' need action soon.',
            ];
        }

        // 2. Disputes open for 48h+
        $oldDisputes = EscrowTransaction::where('status', 'Disputed')
            ->where('updated_at', '<=', $now->copy()->subHours(48))
            ->with('listing')
            ->get();
            
        foreach ($oldDisputes as $dispute) {
            $alerts[] = [
                'type' => 'destructive',
                'title' => 'Dispute ESC-' . $dispute->id . ' open for 48h+',
                'detail' => 'Claim on ' . ($dispute->listing->brand ?? '') . ' ' . ($dispute->listing->model ?? '') . ' awaiting decision.',
            ];
        }

        // 3. Escrow payments held 3 days without shipment
        $heldEscrows = EscrowTransaction::whereIn('status', ['Payment Received', 'Confirmed'])
            ->where('updated_at', '<=', $now->copy()->subDays(3))
            ->get();
            
        foreach ($heldEscrows as $escrow) {
            $alerts[] = [
                'type' => 'info',
                'title' => 'Escrow ESC-' . $escrow->id . ' payment held 3+ days',
                'detail' => 'Seller has not yet marked the item as shipped.',
            ];
        }

        return $alerts;
    }
}
