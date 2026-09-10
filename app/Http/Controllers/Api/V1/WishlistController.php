<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Get the authenticated user's wishlist.
     */
    public function index()
    {
        $wishlists = Wishlist::with('listing')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->get()
            ->pluck('listing');

        return response_success('Wishlist retrieved successfully', $wishlists);
    }

    /**
     * Add or remove a listing from the wishlist.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        $userId = \Illuminate\Support\Facades\Auth::id();
        $listingId = $request->listing_id;

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('listing_id', $listingId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response_success('Listing removed from wishlist.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'listing_id' => $listingId,
        ]);

        return response_success('Listing added to wishlist.', null, 201);
    }
}
