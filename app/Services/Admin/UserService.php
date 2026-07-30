<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Services\BaseService;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class UserService extends BaseService
{
    protected string $modelClass = User::class;

    protected function getAllowedFilters(): array
    {
        return [
            'name',
            'email',
            'phone_number',
            'kyc_status',
            'account_standing',
            AllowedFilter::exact('id'),
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            'kycDocuments',
            'escrowTransactionsAsBuyer',
            'escrowTransactionsAsSeller',
        ];
    }

    protected function getAllowedSorts(): array
    {
        return [
            'name',
            'created_at',
            'account_standing',
            'kyc_status',
            AllowedSort::field('joined', 'created_at'),
        ];
    }
}
