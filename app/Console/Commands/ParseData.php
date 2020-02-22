<?php

namespace App\Console\Commands;

use App\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Inetvi\CurrencyBitcoin\Facades\CurrencyBitcoin;

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
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $coinbase = CurrencyBitcoin::coinbase();
        $localbitcoin = CurrencyBitcoin::localbitcoin();

        $ves = $localbitcoin->getPrice('VES');

        $this->save('VES', 'USD', $ves, $coinbase->getPrice('USD'));
        $this->save('VES', 'COP', $ves, $coinbase->getPrice('COP'));
        $this->save('VES', 'ARS', $ves, $coinbase->getPrice('ARS'));
        $this->save('VES', 'CLP', $ves, $coinbase->getPrice('CLP'));
        $this->save('VES', 'PEN', $ves, $coinbase->getPrice('PEN'));
        $this->save('VES', 'EUR', $ves, $coinbase->getPrice('EUR'));


        Cache::forever('latest:localhost:moved-today:usd',
            round($localbitcoin->raw()['USD']['avg_24h'] * $localbitcoin->raw()['USD']['volume_btc'], 2)
        );

        Cache::forever('latest:localhost:moved-today:ves',
            round($localbitcoin->raw()['VES']['avg_24h'] * $localbitcoin->raw()['VES']['volume_btc'], 2)
        );

        Cache::forever('latest:timestamp', Carbon::now()->timestamp);
    }

    /**
     * @param $source
     * @param $target
     * @param $sourceVal
     * @param $targetVal
     */
    private function save($target, $source, $sourceVal, $targetVal)
    {
        $value = round($sourceVal / $targetVal, 2);

        CurrencyRate::create([
            'source_id' => $source,
            'target_id' => $target,
            'value' => $value
        ]);
    }
}
