<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

/**
 * @group Public Dealers Directory
 *
 * API for fetching public profiles of approved dealers.
 */
class PublicDealerController extends Controller
{
    /**
     * Get Approved Dealers
     *
     * Returns a paginated list of all verified and approved dealers in the platform.
     * Can be searched by name or company name.
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::role('dealer') // Only get users with the 'dealer' role
            ->where('kyc_status', 'approved') // Only show fully approved dealers
            ->select('id', 'name', 'company_name', 'avatar', 'account_standing', 'average_rating', 'total_reviews', 'created_at');

        $dealers = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where(function ($q) use ($value) {
                        $q->where('name', 'like', "%{$value}%")
                          ->orWhere('company_name', 'like', "%{$value}%");
                    });
                }),
                'account_standing'
            ])
            ->allowedSorts(['created_at', 'average_rating'])
            ->defaultSort('-created_at')
            ->paginate($request->input('per_page', 12));

        // Format the output to perfectly match the UI cards
        $formattedDealers = $dealers->through(function ($dealer) {
            return [
                'id' => $dealer->id,
                'name' => $dealer->name,
                'company_name' => $dealer->company_name,
                'avatar' => $dealer->avatar,
                'joined_year' => $dealer->created_at->format('Y'),
                'is_verified' => true,
                'standing' => $dealer->account_standing,
                'rating' => $dealer->average_rating,
                'reviews_count' => $dealer->total_reviews,
                'description' => 'A trusted dealer in the Patina network.', // Placeholder text matching UI
            ];
        });

        return response_success('Dealers retrieved successfully', [
            'dealers' => [
                'data' => $formattedDealers,
                'meta' => [
                    'current_page' => $dealers->currentPage(),
                    'last_page' => $dealers->lastPage(),
                    'per_page' => $dealers->perPage(),
                    'total' => $dealers->total(),
                ]
            ]
        ]);
    }
}
