<?php

namespace App\Exchangers;

use App\Models\ExchangeRate;
use Illuminate\Http\Client\Response;

abstract class Exchanger implements Contracts\ExchangerContract
{
    public function sync(): void
    {
        $response = $this->syncRates();

        $this->storeRates($response->json());
    }

    abstract protected function syncRates(): Response;

    protected function storeRates(array $response): void
    {
        ExchangeRate::insert($this->prepareRates($response));
    }

    abstract protected function prepareRates(array $response): array;
}
