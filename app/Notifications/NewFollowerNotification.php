<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewFollowerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public User $follower;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
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
            'type' => 'new_follower',
            'title' => 'New Follower',
            'message' => "{$this->follower->name} started following you.",
            'follower_id' => $this->follower->id,
            'follower_name' => $this->follower->name,
            // Depending on frontend needs, we could include profile photo URL too
        ];
    }
}
