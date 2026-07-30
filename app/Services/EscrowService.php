<?php

namespace App\Services;

use App\Models\EscrowTransaction;
use Illuminate\Database\Eloquent\Model;

class EscrowService extends BaseService
{
    protected string $modelClass = EscrowTransaction::class;

    protected function getAllowedFilters(): array
    {
        return [
            'status',
            'buyer_id',
            'seller_id',
            'listing_id',
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            'listing',
            'buyer',
            'seller',
            'disputes',
            'reviews',
        ];
    }

    protected function getAllowedSorts(): array
    {
        return [
            'amount',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Create or update an escrow transaction.
     *
     * @param array $data
     * @param EscrowTransaction|null $transaction
     * @return EscrowTransaction
     */
    public function saveTransaction(array $data, ?EscrowTransaction $transaction = null): EscrowTransaction
    {
        $transaction = $transaction ?? new EscrowTransaction();
        
        // Use the ManagesData trait method 'storeOrUpdate' inherited from BaseService
        return $this->storeOrUpdate($data, $transaction);
    }
}
