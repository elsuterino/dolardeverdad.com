<?php

namespace Inetvi\CurrencyBitcoin\Drivers;

use GuzzleHttp\Exception\GuzzleException;

class Localbitcoin implements \Inetvi\CurrencyBitcoin\DriverInterface
{
    private $data;

    public function getPrice(string $currency)
    {
        if(!$this->data){
            $this->data = $this->getData();
        }

        return $this->data[$currency]['avg_1h']
            ?? $this->data[$currency]['avg_6h']
            ?? $this->data[$currency]['avg_12h']
            ?? $this->data[$currency]['avg_24h']
            ?? $this->data[$currency]['rates']['last']
            ?? null;
    }

    public function raw()
    {
        if(!$this->data){
            $this->data = $this->getData();
        }

        return $this->data;
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    private function getData()
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('get', 'https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/');
        } catch (GuzzleException $e) {
            Sleep(10);
            return $this->getData();
        }

        return json_decode($response->getBody(), true);
    }
}
