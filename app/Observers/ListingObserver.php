<?php

namespace App\Observers;

use App\Models\Listing;

class ListingObserver
{
    /**
     * Handle the Listing "created" event.
     */
    public function created(Listing $listing): void
    {
        //
    }

    /**
     * Handle the Listing "updated" event.
     */
    public function updated(Listing $listing): void
    {
        // Check if the listing just became Live
        if ($listing->isDirty('status') && $listing->status === 'Live') {
            // Find all active alerts for this reference number where the target price is >= the listing price
            $alerts = \App\Models\PriceAlert::where('reference_number', $listing->reference_number)
                ->where('is_active', true)
                ->where('target_price', '>=', $listing->price)
                ->get();

            foreach ($alerts as $alert) {
                // Notify the user
                $alert->user->notify(new \App\Notifications\PriceAlertTriggered($listing, $alert));
                
                // Turn off the alert so they don't get spammed
                $alert->update(['is_active' => false]);
            }
        }
    }

    /**
     * Handle the Listing "deleted" event.
     */
    public function deleted(Listing $listing): void
    {
        //
    }

    /**
     * Handle the Listing "restored" event.
     */
    public function restored(Listing $listing): void
    {
        //
    }

    /**
     * Handle the Listing "force deleted" event.
     */
    public function forceDeleted(Listing $listing): void
    {
        //
    }
}
