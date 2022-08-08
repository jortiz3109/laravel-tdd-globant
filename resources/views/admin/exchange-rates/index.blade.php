@extends('layouts.app')
@section('content')
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <span class="navbar-brand h1">{{ trans('Exchange rates') }}</span>
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Refresh
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.exchange-rates.index', request()->only('page') + ['refresh', 'exchanger' => 'openExchange']) }}">
                                Using OpenExchange
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.exchange-rates.index', request()->only('page') + ['refresh', 'exchanger' => 'apiLayer']) }}">
                                Using ApiLayer
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-borderless table-hover table-striped">
                <thead>
                <tr>
                    <th>{{ trans('Date') }}</th>
                    <th>{{ trans('Base') }}</th>
                    <th>{{ trans('To') }}</th>
                    <th>{{ trans('Rate') }}</th>
                    <th>{{ trans('Exchanger') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exchangeRates as $exchangeRate)
                <tr>
                    <td>{{ $exchangeRate->date }}</td>
                    <td>{{ $exchangeRate->base }}</td>
                    <td>{{ $exchangeRate->to }}</td>
                    <td>{{ $exchangeRate->rate }}</td>
                    <td>{{ $exchangeRate->exchanger }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $exchangeRates->links() }}
    </div>
@endsection
