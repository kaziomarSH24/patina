<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\User;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        $this->recalculateUserRating($review->reviewee_id);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        if ($review->isDirty('rating')) {
            $this->recalculateUserRating($review->reviewee_id);
        }
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $this->recalculateUserRating($review->reviewee_id);
    }

    /**
     * Recalculate and update the average rating for a user.
     */
    protected function recalculateUserRating($userId): void
    {
        $user = User::find($userId);
        if (!$user) return;

        $reviews = Review::where('reviewee_id', $userId);
        
        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;

        $user->update([
            'total_reviews' => $totalReviews,
            'average_rating' => round($averageRating, 2),
        ]);
    }
}
