<?php

namespace App\Console\Commands;

use App\Currency;
use App\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use InfluxDB\Client;

class PortInfluxToPostgres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'port:to:postgres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $currencies = Currency::get();

        $client = new Client('localhost', 8086);

        $influxDatabase = $client->selectDB('dolardeverdad');

        foreach($currencies as $currency){
            $data = $influxDatabase->query(/** @lang text */ "SELECT * FROM VES{$currency->id}")
                ->getPoints();

            $this->line("Porting VES to {$currency->id}");

            $this->output->progressStart(count($data));

            foreach($data as $point){
                CurrencyRate::create([
                    'source_id' => $currency->id,
                    'target_id' =>'VES',
                    'value' => $point['value'],
                    'created_at' => Carbon::parse($point['time'])
                ]);

                $this->output->progressAdvance();
            }

            $this->output->progressFinish();
        }
    }
}
