<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use InfluxDB\Client;
use InfluxDB\Database;
use InfluxDB\Point;

class ParseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $influxDatabase;

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \InfluxDB\Database\Exception
     * @throws \InfluxDB\Exception
     * @throws \Exception
     */
    public function handle()
    {
        $client = new Client('localhost', 8086);
        $this->influxDatabase = $client->selectDB('dolardeverdad');

        if (!$this->influxDatabase->exists()) {
//            $this->info('database doesnt exist, creating');
            $this->influxDatabase->create();
        }

        $localbitcoin = $this->apiToArray('https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/');
        $coinbase = $this->apiToArray('https://api.coinbase.com/v2/prices/sell?currency=USD');

        $ves = $localbitcoin['VES']['avg_1h'] ?? $localbitcoin['VES']['avg_6h'] ?? $localbitcoin['VES']['avg_12h'] ?? $localbitcoin['VES']['avg_24h'] ?? $localbitcoin['VES']['rates']['last'] ?? exit;
        $usd = $coinbase['data']['amount'];

        $this->influxDatabase->writePoints([
            new Point(
                'VESvalue', // the name of the measurement
                round($ves / $usd, 2), // measurement value
                [], // measurement tags
                [], // measurement fields
                Carbon::now()->timestamp
            )
        ], Database::PRECISION_SECONDS);

        Cache::forever('chart-dataset',
            $this->makeChartData()
        );

        Cache::forever('latest:ves-local-coinbase',
            round($ves / $usd, 2)
        );

        Cache::forever('latest:localhost:moved-today:usd',
            round($localbitcoin['USD']['avg_24h'] * $localbitcoin['USD']['volume_btc'], 2)
        );

        Cache::forever('latest:localhost:moved-today:ves',
            round($localbitcoin['VES']['avg_24h'] * $localbitcoin['VES']['volume_btc'], 2)
        );

        Cache::forever('latest:timestamp', Carbon::now()->timestamp);
    }

    private function apiToArray($url, $method = 'GET')
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request($method, $url);
        } catch (GuzzleException $e) {
            Sleep(10);
            return $this->apiToArray($url, $method);
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws \InfluxDB\Exception
     * @throws \Exception
     */
    private function makeChartData()
    {
        $firstEntry =  $this->influxDatabase->query("SELECT * FROM VESvalue ORDER BY time ASC LIMIT 1")->getPoints();

        if(!isset($firstEntry[0])){
            exit;
        }

        $interval = ceil(Carbon::parse($firstEntry[0]['time'])->diffInHours() / 500);

        $chartData = $this->influxDatabase
            ->query("SELECT MEDIAN(*) FROM VESvalue GROUP BY time({$interval}h)")
            ->getSeries();

        $chart = [[
            'name' => 'some name here',
            'type' => 'line',
            'smooth' => false,
            'symbol' => 'none',
            'sampling' => 'average',
            'itemStyle' => [
                'color' => '#fff'
            ],
            'lineStyle' => [
                'width' => 1,
            ],
            'areaStyle' => [
                'color' => 'rgba(255,255,255,0.2)'
            ],
            'connectNulls' => true,
            'data' => $chartData[0]['values']
        ]];

        return $chart;
    }
}
