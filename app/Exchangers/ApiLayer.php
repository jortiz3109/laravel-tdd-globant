<?php

namespace App\Exchangers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ApiLayer extends Exchanger
{
    protected function syncRates(): Response
    {
        return Http::exchangerApiLayer()->get('/latest', [
            'symbols' => 'COP',
            'base' => 'USD'
        ]);
    }

    protected function prepareRates(array $response): array
    {
        return collect($response['rates'])->map(function($rate, $currency) use ($response) {
            return [
                'base' => $response['base'],
                'to' => $currency,
                'rate' => $rate,
                'date' => $response['date'],
                'exchanger' => 'ApiLayer'
            ];
        })->values()->toArray();
    }
}
