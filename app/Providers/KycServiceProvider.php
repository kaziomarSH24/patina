<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\KycProviderInterface;
use App\Services\ThirdParty\HypervergeMockService;

class KycServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the interface to our mock service.
        // Once real credentials are provided, swap HypervergeMockService with the real HypervergeService here.
        $this->app->bind(KycProviderInterface::class, HypervergeMockService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
