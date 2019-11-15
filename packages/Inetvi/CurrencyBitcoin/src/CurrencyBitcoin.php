<?php

namespace Inetvi\CurrencyBitcoin;

use Inetvi\CurrencyBitcoin\Drivers\Coinbase;
use Inetvi\CurrencyBitcoin\Drivers\Localbitcoin;

class CurrencyBitcoin
{
    public function coinbase()
    {
        return new Coinbase();
    }

    public function localbitcoin()
    {
        return new Localbitcoin();
    }
}
