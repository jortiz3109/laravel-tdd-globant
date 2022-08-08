<?php

namespace App\Exchangers;

use App\Models\ExchangeRate;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

abstract class Exchanger implements Contracts\ExchangerContract
{
    public function sync(): void
    {
        $response = $this->syncRates();

        $this->storeRates($response->json());
    }

    protected function storeRates(array $response): void
    {
        ExchangeRate::insert($this->prepareRates($response));
    }

    abstract protected function syncRates(): Response;
    abstract protected function prepareRates(array $response): array;
}
