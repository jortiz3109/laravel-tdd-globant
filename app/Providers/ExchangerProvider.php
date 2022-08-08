<?php

namespace App\Providers;

use App\Exchangers\ApiLayer;
use App\Exchangers\Contracts\ExchangerContract;
use App\Exchangers\OpenExchange;
use Illuminate\Support\ServiceProvider;

class ExchangerProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(ExchangerContract::class, function ($app) {
            if ($this->shouldLoadMock()) {
                return $this->loadMock();
            }

            return match (request()->get('exchanger')) {
                'apiLayer' => new ApiLayer(),
                default => new OpenExchange()
            };
        });
    }

    private function shouldLoadMock(): bool
    {
        return true === config('exchangers.mocks.enabled');
    }

    private function loadMock(): ExchangerContract
    {
        $mockClass = config('exchangers.mocks.class');

        return new $mockClass();
    }
}
