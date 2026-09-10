<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EscrowTransaction;
use App\Models\Review;
use App\Models\User;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Get all reviews for a specific user (seller).
     */
    public function userReviews($userId)
    {
        $user = User::findOrFail($userId);
        $reviews = Review::with('reviewer:id,name,avatar')
            ->where('reviewee_id', $userId)
            ->latest()
            ->paginate(15);

        return response_success('Reviews fetched successfully.', [
            'seller' => [
                'id' => $user->id,
                'name' => $user->name,
                'average_rating' => $user->average_rating,
                'total_reviews' => $user->total_reviews,
            ],
            'reviews' => $reviews
        ]);
    }

    /**
     * Store a newly created review.
     */
    public function store(StoreReviewRequest $request)
    {
        $transaction = EscrowTransaction::findOrFail($request->transaction_id);

        // Ensure the transaction is completed
        if ($transaction->status !== 'Completed') {
            return response_error('You can only review a completed transaction.', [], 400);
        }

        // Ensure the authenticated user is the buyer
        if ($transaction->buyer_id !== Auth::id()) {
            return response_error('Only the buyer can leave a review.', [], 403);
        }

        // Ensure a review doesn't already exist for this transaction
        if (Review::where('transaction_id', $transaction->id)->exists()) {
            return response_error('You have already reviewed this transaction.', [], 400);
        }

        $review = Review::create([
            'transaction_id' => $transaction->id,
            'reviewer_id' => Auth::id(),
            'reviewee_id' => $transaction->seller_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response_success('Review submitted successfully.', $review, 201);
    }
}
