<?php

namespace App\Console\Commands;

use App\Models\EscrowTransaction;
use App\Services\BlueDartService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateEscrowShippingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'escrow:update-shipping-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks BlueDart tracking for shipped orders and auto-confirms delivery.';

    /**
     * Execute the console command.
     */
    public function handle(BlueDartService $blueDartService)
    {
        $this->info('Starting Escrow Shipping Status Update...');

        // Find all shipped escrows that used BlueDart
        $shippedEscrows = EscrowTransaction::where('status', 'Shipped')
            ->where('shipping_provider', 'BlueDart')
            ->whereNotNull('tracking_number')
            ->get();

        if ($shippedEscrows->isEmpty()) {
            $this->info('No pending shipped orders found.');
            return;
        }

        foreach ($shippedEscrows as $escrow) {
            $this->info("Checking AWB: {$escrow->tracking_number} for Escrow #{$escrow->id}");

            $result = $blueDartService->trackShipment($escrow->tracking_number);

            if ($result['success'] && $result['delivered']) {
                // Auto-confirm the delivery
                $escrow->update(['status' => 'Confirmed']);
                
                // Notify seller
                if ($escrow->seller) {
                    $escrow->seller->notify(new \App\Notifications\EscrowStatusNotification($escrow, 'confirmed'));
                }

                $this->info("Escrow #{$escrow->id} marked as Confirmed.");
                Log::info("Cron: Auto-confirmed Escrow #{$escrow->id} via BlueDart tracking.");
            } else {
                $this->line("AWB {$escrow->tracking_number} is still in transit.");
            }
        }

        $this->info('Update complete.');
    }
}
