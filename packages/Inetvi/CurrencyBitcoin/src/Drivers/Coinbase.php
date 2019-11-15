<?php

namespace Inetvi\CurrencyBitcoin\Drivers;

class Coinbase implements \Inetvi\CurrencyBitcoin\DriverInterface
{
    public function getPrice(string $currency)
    {
        $data = $this->getData($currency);
        return $data['data']['amount'];
    }

    /**
     * @param  string  $currency
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getData(string $currency)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('get', "https://api.coinbase.com/v2/prices/sell?currency={$currency}");

        return json_decode($response->getBody(), true);
    }
}
