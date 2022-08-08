<?php

namespace App\Exchangers;

use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OpenExchange extends Exchanger
{
    protected function syncRates(): Response
    {
        return Http::exchangerOpenExchange()->get('/latest.json', [
            'app_id' => config('exchangers.open-exchange.app-id'),
            'base' => 'USD',
            'symbols' => 'COP'
        ]);
    }

    protected function prepareRates(array $response): array
    {
        return collect($response['rates'])->map(function ($rate, $currency) use ($response) {
            return [
                'base' => $response['base'],
                'to' => $currency,
                'rate' => $rate,
                'date' => Carbon::createFromTimestamp($response['timestamp']),
                'exchanger' => 'OpenExchange'
            ];
        })->values()->toArray();
    }
}
