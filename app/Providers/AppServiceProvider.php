<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Rest;
use Shopify\Context;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Context::initialize(
            config('shopify.api_key'),
            config('shopify.api_secret'),
            config('shopify.app_scopes'),
            config('shopify.app_hostname'),
            new FileSessionStorage(storage_path('temp/php_sessions')),
            '2024-04',
            false,
            true,

        );

        $this->app->singleton(Rest::class, function () {
            return new Rest(
                config('shopify.app_hostname'),
                config('shopify.api_secret')
            );
        });
    }
}
