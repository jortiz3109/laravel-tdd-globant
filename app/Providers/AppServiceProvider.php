<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Http::macro('exchangerApiLayer', function () {
            return Http::withHeaders([
                'apikey' => config('exchangers.api-layer.app-id'),
            ])->baseUrl(config('exchangers.api-layer.endpoint'));
        });

        Http::macro('exchangerOpenExchange', function () {
            return Http::baseUrl(config('exchangers.open-exchange.endpoint'));
        });
    }
}
