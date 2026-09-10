<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Listing;
use App\Models\PriceAlert;

class PriceAlertTriggered extends Notification implements ShouldQueue
{
    use Queueable;

    public Listing $listing;
    public PriceAlert $priceAlert;

    /**
     * Create a new notification instance.
     */
    public function __construct(Listing $listing, PriceAlert $priceAlert)
    {
        $this->listing = $listing;
        $this->priceAlert = $priceAlert;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // For now, save it to the database for in-app notifications
        return ['database']; 
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'price_alert',
            'title' => 'Price Alert Triggered!',
            'message' => "Good news! A {$this->listing->brand} {$this->listing->model} has just been listed for ₹{$this->listing->price}, which meets your alert threshold of ₹{$this->priceAlert->target_price}.",
            'listing_id' => $this->listing->id,
            'reference_number' => $this->listing->reference_number,
            'price' => $this->listing->price,
        ];
    }
}
