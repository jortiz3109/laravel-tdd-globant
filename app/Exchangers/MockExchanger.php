<?php

namespace App\Exchangers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class MockExchanger extends OpenExchange
{

    protected function syncRates(): Response
    {
        $this->prepareMock();
        return parent::syncRates();
    }

    private function prepareMock(): void
    {
        $data = [
            'disclaimer' => 'Usage subject to terms: https://openexchangerates.org/terms',
            'license' => 'https://openexchangerates.org/license',
            'timestamp' => now()->timestamp,
            'base' => 'USD',
            'rates' =>  [
                'COP' => 6000
            ]
        ];

        Http::fake([
            'https://openexchangerates.org/api/*' => Http::response($data),
        ]);
    }

    protected function prepareRates(array $response): array
    {
        $values = parent::prepareRates($response);
        return collect($values)->map(function($rate) {
            $rate['exchanger'] = 'MockExchanger';
            return $rate;
        })->toArray();
    }
}
