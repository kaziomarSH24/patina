<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Dispute;

class DisputeResolvedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $dispute;
    protected $resolution;

    /**
     * Create a new notification instance.
     */
    public function __construct(Dispute $dispute, string $resolution)
    {
        $this->dispute = $dispute;
        $this->resolution = $resolution; // 'seller' or 'buyer'
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $role = $notifiable->id === $this->dispute->escrowTransaction->seller_id ? 'seller' : 'buyer';
        $won = $role === $this->resolution;

        $subject = 'Update on your Dispute for Transaction #' . $this->dispute->escrowTransaction->reference;
        $message = (new MailMessage)->subject($subject)->greeting('Hello ' . $notifiable->name . ',');

        if ($won) {
            $message->line('Good news. The dispute for your transaction has been resolved in your favor.')
                    ->line($role === 'seller' ? 'The funds will now be released to your account.' : 'A full refund will be issued to your original payment method.');
        } else {
            $message->line('The dispute for your transaction has been reviewed and resolved.')
                    ->line('Unfortunately, the resolution was not in your favor based on our investigation.');
        }

        return $message->action('View Transaction', url(env('FRONTEND_URL', 'http://localhost:3000') . '/dashboard/transactions'))
                       ->line('Thank you for using Patina.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $role = $notifiable->id === $this->dispute->escrowTransaction->seller_id ? 'seller' : 'buyer';
        $won = $role === $this->resolution;
        
        return [
            'type' => 'dispute_resolved',
            'dispute_id' => $this->dispute->id,
            'escrow_id' => $this->dispute->escrow_transaction_id,
            'resolution' => $this->resolution,
            'message' => $won ? 'Dispute resolved in your favor.' : 'Dispute resolved.',
        ];
    }
}
