<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use InfluxDB\Database;
use InfluxDB\Database\RetentionPolicy;
use InfluxDB\Point;
use InfluxDB\Client;

class MigrateToInflux extends Command
{
    protected $signature = 'migratetoinflux';
    protected $description = 'Command description';
    protected $influxDatabase;

    /**
     * MigrateToInflux constructor.
     * @throws Database\Exception
     */
    public function __construct()
    {
        $client = new Client('localhost', 8086);
        $this->influxDatabase = $client->selectDB('dolardeverdad');

        if (!$this->influxDatabase->exists()) {
//            $this->info('database doesnt exist, creating');
            $this->influxDatabase->create();
        }

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Database\Exception
     * @throws \InfluxDB\Exception
     */
    public function handle()
    {
        $history = DB::table('venezuela_bitcoin_statistics')->get();

        $points = [];

        foreach($history as $point){
            $data = json_decode($point->data);
            $ves = $data->VES->avg_1h ?? $data->localVES;
            $usd = $data->USD->amount ?? $data->USD;

            $points[] = new Point(
                'VESvalue', // the name of the measurement
                round($ves / $usd, 2), // measurement value
                [], // measurement tags
                [], // measurement fields
                Date::parse($point->created_at)->timestamp // timestamp in nanoseconds on Linux ONLY
            );
        }

        $this->influxDatabase->writePoints($points, Database::PRECISION_SECONDS);
    }
}
