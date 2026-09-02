<?php

namespace App\Http\Controllers\Api\V1\Chat;

use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\MessageResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Chat
 * @subgroup Offers
 * 
 * Manage offers within a chat conversation.
 */
class OfferController extends Controller
{
    /**
     * Send an Offer
     *
     * Creates an offer and sends an interactive message to the conversation.
     */
    public function store(Request $request, Conversation $conversation)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:500',
        ]);

        if (!$conversation->listing_id) {
            return response_error('This conversation is not linked to any watch listing.', [], 400);
        }

        // Check if user is the buyer (not the seller of the listing)
        $listing = $conversation->listing;
        if ($listing->user_id === $request->user()->id) {
            return response_error('You cannot make an offer on your own listing.', [], 400);
        }

        DB::beginTransaction();
        try {
            // Create Offer in database
            $offer = Offer::create([
                'listing_id' => $listing->id,
                'buyer_id' => $request->user()->id,
                'amount' => $validated['amount'],
                'status' => 'Pending',
            ]);

            // Create Interactive System Message
            $message = $conversation->messages()->create([
                'user_id' => $request->user()->id,
                'body' => null, // No standard text body
                'type' => 'offer',
                'metadata' => [
                    'offer_id' => $offer->id,
                    'amount' => $offer->amount,
                    'note' => $validated['note'] ?? null,
                    'status' => $offer->status,
                ]
            ]);

            DB::commit();

            // Broadcast to other users in chat via Reverb
            broadcast(new MessageSent($message))->toOthers();

            return response_success('Offer sent successfully.', new MessageResource($message), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error('Failed to send offer.', ['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Accept or Decline an Offer
     *
     * The seller can accept or decline the offer. This updates the original offer message.
     */
    public function updateStatus(Request $request, Conversation $conversation, Offer $offer)
    {
        $validated = $request->validate([
            'status' => 'required|in:Accepted,Declined',
        ]);

        // Ensure the offer belongs to this conversation's listing
        if ($offer->listing_id !== $conversation->listing_id) {
            return response_error('This offer does not belong to this conversation.', [], 400);
        }

        // Only the seller can accept or decline
        if ($offer->listing->user_id !== $request->user()->id) {
            return response_error('Only the seller can update the offer status.', [], 403);
        }

        // Check if offer is already processed
        if ($offer->status !== 'Pending') {
            return response_error('This offer is already ' . $offer->status, [], 400);
        }

        DB::beginTransaction();
        try {
            // Update the Offer status
            $offer->update(['status' => $validated['status']]);

            // Find the original system message linked to this offer and update its metadata
            $message = $conversation->messages()
                ->where('type', 'offer')
                ->whereJsonContains('metadata->offer_id', $offer->id)
                ->first();

            if ($message) {
                $metadata = $message->metadata;
                $metadata['status'] = $validated['status'];
                $message->update(['metadata' => $metadata]);

                // Broadcast the updated message so UI buttons update dynamically
                broadcast(new \App\Events\Chat\MessageUpdated($message))->toOthers();
            }

            // Create a text reply automatically stating the action
            $replyMessage = $conversation->messages()->create([
                'user_id' => $request->user()->id,
                'body' => $validated['status'] === 'Accepted' 
                    ? 'I have accepted your offer of ₹' . number_format($offer->amount) . '.' 
                    : 'I have declined the offer of ₹' . number_format($offer->amount) . '.',
                'type' => 'text'
            ]);

            DB::commit();

            broadcast(new MessageSent($replyMessage))->toOthers();

            return response_success('Offer ' . strtolower($validated['status']) . ' successfully.', [
                'offer' => $offer,
                'message' => new MessageResource($message)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response_error('Failed to update offer.', ['error' => $e->getMessage()], 500);
        }
    }
}
