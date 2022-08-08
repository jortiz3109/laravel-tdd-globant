<?php

namespace App\Http\Controllers\Admin;

use App\Exchangers\Contracts\ExchangerContract;
use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExchangeRatesController extends Controller
{
    public function index(Request $request): View
    {
        $exchangeRates = ExchangeRate::paginate();

        return view('admin.exchange-rates.index', compact('exchangeRates'));
    }
}
