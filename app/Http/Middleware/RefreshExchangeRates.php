<?php

namespace App\Http\Middleware;

use App\Exchangers\Contracts\ExchangerContract;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RefreshExchangeRates
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('refresh')) {
            $exchanger = app(ExchangerContract::class);
            $exchanger->sync();
        }

        return $next($request);
    }
}
