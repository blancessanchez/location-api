<?php

namespace App\Providers;

use App\Services\LocationApi;
use Illuminate\Support\ServiceProvider;

class LocationApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LocationApi::class, function ($app) {
            $apiKey = config('location.api_key');
            return new LocationApi($apiKey);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
