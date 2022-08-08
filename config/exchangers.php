<?php

use App\Exchangers\MockExchanger;
use App\Exchangers\OpenExchange;

return [
    'default' => OpenExchange::class,
    'mocks' => [
        'enabled' => env('EXCHANGERS_MOCKS_ENABLED', false),
        'class' => MockExchanger::class,
    ],
    'open-exchange' => [
        'endpoint' => env('EXCHANGERS_OPEN_EXCHANGE_ENDPOINT', 'https://openexchangerates.org/api/'),
        'app-id' => env('EXCHANGERS_OPEN_EXCHANGE_APP_ID'),
    ],
    'api-layer' => [
        'endpoint' => env('EXCHANGERS_API_LAYER_EXCHANGE_ENDPOINT', 'https://api.apilayer.com/exchangerates_data/'),
        'app-id' => env('EXCHANGERS_API_LAYER_EXCHANGE_API_KEY'),
    ]
];

