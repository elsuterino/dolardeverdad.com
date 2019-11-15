<?php


namespace Inetvi\CurrencyBitcoin;


interface DriverInterface
{
    public function getPrice(string $currency);
}
