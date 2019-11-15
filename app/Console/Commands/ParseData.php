<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Inetvi\CurrencyBitcoin\Facades\CurrencyBitcoin;
use InfluxDB\Client;
use InfluxDB\Database;
use InfluxDB\Exception;
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

    /**
     * @var Database
     */
    protected $influxDatabase;

    /**
     * Execute the console command.
     *
     * @throws Exception
     * @throws \Exception
     */
    public function handle()
    {
        $this->influxDatabase = $this->influxDatabase();

        $coinbase = CurrencyBitcoin::coinbase();
        $localbitcoin = CurrencyBitcoin::localbitcoin();

        $ves = $localbitcoin->getPrice('VES');

        $this->save('VESvalue', 'VES', 'USD', $ves, $coinbase->getPrice('USD'));
        $this->save('VESCOP', 'VES', 'COP', $ves, $coinbase->getPrice('COP'));
        $this->save('VESARS', 'VES', 'ARS', $ves, $coinbase->getPrice('ARS'));
        $this->save('VESCLP', 'VES', 'CLP', $ves, $coinbase->getPrice('CLP'));
        $this->save('VESPEN', 'VES', 'PEN', $ves, $coinbase->getPrice('PEN'));
        $this->save('VESEUR', 'VES', 'EUR', $ves, $coinbase->getPrice('EUR'));


        Cache::forever('latest:localhost:moved-today:usd',
            round($localbitcoin->raw()['USD']['avg_24h'] * $localbitcoin->raw()['USD']['volume_btc'], 2)
        );

        Cache::forever('latest:localhost:moved-today:ves',
            round($localbitcoin->raw()['VES']['avg_24h'] * $localbitcoin->raw()['VES']['volume_btc'], 2)
        );

        Cache::forever('latest:timestamp', Carbon::now()->timestamp);
    }

    /**
     * @param $DBKey
     * @param $source
     * @param $target
     * @param $sourceVal
     * @param $targetVal
     * @throws Exception
     */
    private function save($DBKey, $source, $target, $sourceVal, $targetVal)
    {
        $value = round($sourceVal / $targetVal, 2);

        $this->saveInDatabase($DBKey, $value);

        Cache::forever($source . $target, [
            'source' => $source,
            'target' => $target,
            'value' => $value,
            'chartData' => $this->makeChartData($DBKey),
            'created_at' => now()
        ]);
    }

    /**
     * @return Database
     */
    private function influxDatabase()
    {
        $client = new Client('localhost', 8086);

        $influxDatabase = $client->selectDB('dolardeverdad');

        if (!$influxDatabase->exists()) {
            try {
                $influxDatabase->create();
            } catch (Database\Exception $e) {
                log('failed creating database');
            }
        }

        return $influxDatabase;
    }

    /**
     * @param  string  $key
     * @param $value
     * @throws Database\Exception
     * @throws Exception
     */
    private function saveInDatabase(string $key, $value)
    {
        $this->influxDatabase->writePoints([
            new Point(
                $key, // the name of the measurement
                $value, // measurement value
                [], // measurement tags
                [], // measurement fields
                Carbon::now()->timestamp
            ),
        ], Database::PRECISION_SECONDS);
    }

    /**
     * @param $key
     * @return array
     * @throws Client\Exception
     * @throws \Exception
     */
    private function makeChartData($key)
    {
        $firstEntry = $this->influxDatabase->query(/** @lang text */ "SELECT * FROM {$key} ORDER BY time ASC LIMIT 1")->getPoints();

        if (!isset($firstEntry[0])) {
            exit;
        }

        $interval = ceil(Carbon::parse($firstEntry[0]['time'])->diffInHours() / 500);

        $chartData = $this->influxDatabase
            ->query(/** @lang text */ "SELECT MEDIAN(*) FROM {$key} GROUP BY time({$interval}h)")
            ->getSeries();

        $chart = [
            [
                'name' => 'some name here',
                'type' => 'line',
                'smooth' => false,
                'symbol' => 'none',
                'sampling' => 'average',
                'itemStyle' => [
                    'color' => '#fff',
                ],
                'lineStyle' => [
                    'width' => 1,
                ],
                'areaStyle' => [
                    'color' => 'rgba(255,255,255,0.2)',
                ],
                'connectNulls' => true,
                'data' => $chartData[0]['values'],
            ],
        ];

        return $chart;
    }
}
