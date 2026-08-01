<?php

namespace App\Services;

use App\Models\Listing;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingService extends BaseService
{
    use FileUploadTrait;

    protected string $modelClass = Listing::class;

    protected function getAllowedFilters(): array
    {
        return [
            'brand',
            'model',
            'status',
            'is_verified',
            'seller_id',
            'sale_method',
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

    /**
     * Create a new listing with image upload handling.
     *
     * @param Request $request
     * @param array $data
     * @return Listing
     */
    public function createListingWithImages(Request $request, array $data): Listing
    {
        $data['seller_id'] = Auth::id();
        $data['status'] = 'Under Review'; // Requires admin review
        $data['is_verified'] = false; // Requires admin verification

        // Handle multiple image uploads using the existing FileUploadTrait
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $imagesCount = count($request->file('images'));
            
            for ($i = 0; $i < $imagesCount; $i++) {
                $fieldName = "images.{$i}";
                // Use handleFileUpload to compress, convert to webp, and store
                $path = $this->handleFileUpload(
                    $request,
                    $fieldName,
                    'listings/images', // directory
                    800, // max width
                    null, // max height
                    80, // quality
                    true // force WebP
                );

                if ($path) {
                    $imagePaths[] = $path;
                }
            }
        }
        
        if (!empty($imagePaths)) {
            $data['images'] = $imagePaths;
        }

        return $this->create($data);
    }
}
