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

    /**
     * Refund an escrow transaction
     */
    public function refundEscrow(EscrowTransaction $escrow): EscrowTransaction
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($escrow) {
            // TODO: Call Razorpay API to process refund
            
            $escrow->update(['status' => 'Refunded']);
            return $escrow;
        });
    }

    /**
     * Release funds to seller
     */
    public function releaseEscrow(EscrowTransaction $escrow): EscrowTransaction
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($escrow) {
            // TODO: Call Razorpay Route Transfer API
            
            $escrow->update(['status' => 'Completed']);
            return $escrow;
        });
    }
}
