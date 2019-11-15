<?php

namespace Inetvi\CurrencyBitcoin\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyBitcoin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'currencybitcoin';
    }
}
