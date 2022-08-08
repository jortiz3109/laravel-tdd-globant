<?php

namespace Tests\Feature\Admin\ExchangeRates;

use App\Exchangers\Contracts\ExchangerContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class ExchangeRatesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_exchanges(): void
    {
        $response = $this->get('/admin/exchange-rates/');

        $response->assertOk();
        $response->assertSee(trans('Date'));
    }

    public function test_it_calls_a_exchanger(): void
    {
        $this->mock(ExchangerContract::class, function (MockInterface $mock) {
            $mock->shouldReceive('sync')->once();
        });

        $response = $this->get('/admin/exchange-rates/?refresh');

        $response->assertOk();
        $response->assertSee(trans('Date'));
    }

    public function test_it_calls_a_exchanger_spy(): void
    {
        $spy = $this->spy(ExchangerContract::class);

        $this->get('/admin/exchange-rates/?refresh');

        $spy->shouldReceive('storeRates');
    }

    public function test_it_refresh_exchange_rates(): void
    {
        $this->get('/admin/exchange-rates/?refresh');

        $this->assertDatabaseHas('exchange_rates', [
            'base' => 'USD',
            'to' => 'COP',
            'rate' => 6000.00,
            'date' => now()->toDateString(),
        ]);
    }
}
