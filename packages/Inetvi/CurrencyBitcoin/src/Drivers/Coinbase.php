<?php

namespace Inetvi\CurrencyBitcoin\Drivers;

use GuzzleHttp\Exception\GuzzleException;

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

        try {
            $response = $client->request('get', "https://api.coinbase.com/v2/prices/sell?currency={$currency}");
        } catch (GuzzleException $e) {
            Sleep(10);
            return $this->getData($currency);
        }

        return json_decode($response->getBody(), true);
    }
}
