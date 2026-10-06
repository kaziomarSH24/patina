<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use App\Models\EscrowTransaction;
use App\Models\User;
use App\Notifications\CriticalAdminAlertNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class GenerateCriticalAdminAlerts extends Command
{
    protected $signature = 'notifications:generate-critical';
    protected $description = 'Scan database for critical SLA breaches and send database notifications to admins';

    public function handle()
    {
        $now = Carbon::now();
        $admins = User::role('admin')->get();

        if ($admins->isEmpty()) {
            $this->info('No admins found.');
            return;
        }

        $this->info('Scanning for critical alerts...');

        // 1. Photo reviews approaching SLA (Under Review for > 20 hours)
        $pendingReviews = Listing::where('status', 'Under Review')
            ->where('created_at', '<=', $now->copy()->subHours(20))
            ->get();
            
        if ($pendingReviews->count() > 0) {
            $ids = $pendingReviews->take(2)->pluck('id')->map(fn($id) => 'PAT-'.$id)->implode(' and ');
            $suffix = $pendingReviews->count() > 2 ? ' and others' : '';
            
            $title = $pendingReviews->count() . ' photo reviews approaching 24h SLA';
            $detail = $ids . $suffix . ' need action soon.';
            
            // Send to admins (deduplication logic could be added here if needed, but for now we just send it)
            Notification::send($admins, new CriticalAdminAlertNotification('warning', $title, $detail));
            $this->info("Sent SLA warning for {$pendingReviews->count()} reviews.");
        }

        // 2. Disputes open for 48h+
        $oldDisputes = EscrowTransaction::where('status', 'Disputed')
            ->where('updated_at', '<=', $now->copy()->subHours(48))
            ->with('listing')
            ->get();
            
        foreach ($oldDisputes as $dispute) {
            $title = 'Dispute ESC-' . $dispute->id . ' open for 48h+';
            $detail = 'Claim on ' . ($dispute->listing->brand ?? '') . ' ' . ($dispute->listing->model ?? '') . ' awaiting decision.';
            
            Notification::send($admins, new CriticalAdminAlertNotification('destructive', $title, $detail));
            $this->info("Sent Dispute alert for ESC-{$dispute->id}.");
        }

        // 3. Escrow payments held 3 days without shipment
        $heldEscrows = EscrowTransaction::whereIn('status', ['Payment Received', 'Confirmed'])
            ->where('updated_at', '<=', $now->copy()->subDays(3))
            ->get();
            
        foreach ($heldEscrows as $escrow) {
            $title = 'Escrow ESC-' . $escrow->id . ' payment held 3+ days';
            $detail = 'Seller has not yet marked the item as shipped.';
            
            Notification::send($admins, new CriticalAdminAlertNotification('info', $title, $detail));
            $this->info("Sent held escrow alert for ESC-{$escrow->id}.");
        }

        $this->info('Finished generating critical alerts.');
    }
}
