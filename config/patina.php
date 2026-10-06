<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Patina Business Logic Settings
    |--------------------------------------------------------------------------
    |
    | Here you can define default fees, commissions, and promo settings.
    |
    */

    'fees' => [
        'shipping' => (float) env('PATINA_SHIPPING_FEE', 500.00),
        'default_commission' => (float) env('PATINA_DEFAULT_COMMISSION', 4.00),
        'listing' => (float) env('PATINA_LISTING_FEE', 999.00),
    ],

    'plans' => [
        'tier_1' => [
            'slug' => 'tier-1-dealer',
            'trial_days' => 7,
        ],
        'tier_2' => [
            'slug' => 'tier-2-dealer',
            'defer_days' => 30,
            'upfront_percentage' => 0.50, // 50%
        ],
        'tier_3' => [
            'slug' => 'tier-3-dealer',
            'defer_days' => 30,
            'upfront_percentage' => 0.75, // 25% off means paying 75%
        ],
    ],
];
