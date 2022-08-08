<?php

namespace App\Exchangers\Contracts;

interface ExchangerContract
{
    public function sync(): void;
}
