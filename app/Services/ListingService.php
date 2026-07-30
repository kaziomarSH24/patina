<?php

namespace App\Services;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

class ListingService extends BaseService
{
    protected string $modelClass = Listing::class;

    protected function getAllowedFilters(): array
    {
        return [
            'brand',
            'model',
            'status',
            'is_verified',
            'seller_id',
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            'seller',
            'escrowTransactions',
            'offers',
        ];
    }

    protected function getAllowedSorts(): array
    {
        return [
            'price',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Create or update a listing.
     *
     * @param array $data
     * @param Listing|null $listing
     * @return Listing
     */
    public function saveListing(array $data, ?Listing $listing = null): Listing
    {
        $listing = $listing ?? new Listing();
        
        // Use the ManagesData trait method 'storeOrUpdate' inherited from BaseService
        return $this->storeOrUpdate($data, $listing);
    }
}
