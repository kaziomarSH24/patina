<?php

namespace Tests\Feature;

use App\Models\EscrowTransaction;
use App\Models\Listing;
use App\Models\User;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    protected User $buyer;
    protected User $seller;
    protected Listing $listing;
    protected EscrowTransaction $transaction;

    protected function setUp(): void
    {
        parent::setUp();

        // Setup common data
        $this->buyer = clone User::factory()->create();
        $this->seller = clone User::factory()->create();

        $this->listing = clone Listing::create([
            'seller_id' => $this->seller->id,
            'brand' => 'Rolex',
            'model' => 'Submariner',
            'reference_number' => '116610LN',
            'price' => 10000.00,
            'status' => 'Live',
            'is_verified' => true,
        ]);

        $this->transaction = clone EscrowTransaction::create([
            'listing_id' => $this->listing->id,
            'buyer_id' => $this->buyer->id,
            'seller_id' => $this->seller->id,
            'amount' => 10000.00,
            'commission_amount' => 500.00,
            'status' => 'Completed',
        ]);
    }

    public function test_buyer_can_submit_review_for_completed_transaction()
    {
        $response = $this->actingAs($this->buyer)->postJson('/api/v1/reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 5,
            'comment' => 'Great seller!',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 5,
        ]);
    }

    public function test_cannot_review_if_transaction_not_completed()
    {
        $this->transaction->update(['status' => 'Shipped']);

        $response = $this->actingAs($this->buyer)->postJson('/api/v1/reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 4,
        ]);

        $response->assertStatus(400)
            ->assertJsonPath('message', 'You can only review a completed transaction.');
    }

    public function test_only_buyer_can_leave_review()
    {
        $otherUser = User::factory()->create();

        $response = $this->actingAs($otherUser)->postJson('/api/v1/reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 5,
        ]);

        $response->assertStatus(403)
            ->assertJsonPath('message', 'Only the buyer can leave a review.');
    }

    public function test_cannot_review_same_transaction_twice()
    {
        // First review
        $this->actingAs($this->buyer)->postJson('/api/v1/reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 5,
        ]);

        // Second review
        $response = $this->actingAs($this->buyer)->postJson('/api/v1/reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 4,
        ]);

        $response->assertStatus(400)
            ->assertJsonPath('message', 'You have already reviewed this transaction.');
    }

    public function test_observer_auto_calculates_average_rating()
    {
        // Submit 1st review (Rating: 4)
        $this->actingAs($this->buyer)->postJson('/api/v1/reviews', [
            'transaction_id' => $this->transaction->id,
            'rating' => 4,
        ]);

        $this->seller->refresh();
        $this->assertEquals(4.00, $this->seller->average_rating);
        $this->assertEquals(1, $this->seller->total_reviews);

        // Setup a 2nd transaction with a different buyer for the same seller
        $buyer2 = User::factory()->create();
        $transaction2 = clone EscrowTransaction::create([
            'listing_id' => $this->listing->id,
            'buyer_id' => $buyer2->id,
            'seller_id' => $this->seller->id,
            'amount' => 10000.00,
            'status' => 'Completed',
        ]);

        // Submit 2nd review (Rating: 5)
        $this->actingAs($buyer2)->postJson('/api/v1/reviews', [
            'transaction_id' => $transaction2->id,
            'rating' => 5,
        ]);

        $this->seller->refresh();
        // Average of 4 and 5 should be 4.5
        $this->assertEquals(4.50, $this->seller->average_rating);
        $this->assertEquals(2, $this->seller->total_reviews);
    }
}
