<?php

namespace App\Http\Controllers;

use App\Currency;
use App\CurrencyRate;
use Artesaos\SEOTools\Facades\JsonLd;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use InfluxDB\Client;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $currencyRates = CurrencyRate::where('target_id', 'VES')
            ->selectRaw("
                LAST(value, created_at) / FIRST(value, created_at) * 100 - 100 as gross,
                LAST(value, created_at) as value,
                FIRST(source_id, created_at) as source_id,
                FIRST(target_id, created_at) as target_id
            ")
            ->with(['source', 'target'])
            ->where('created_at', '>', now()->subDay())
            ->groupBy('source_id')
            ->orderByDesc('value')
            ->get()
            ->map(function ($currencyRate) {
                return [
                    'gross' => $currencyRate['gross'],
                    'value' => $currencyRate['value'],
                    'source' => [
                        'id' => $currencyRate['source']['id'],
                        'name' => $currencyRate['source']['name_es'],
                    ],
                    'target' => [
                        'id' => $currencyRate['target']['id'],
                        'name' => $currencyRate['target']['name_es'],
                    ],
                ];
            });

        JsonLd::addValue("mainEntity", [
            "@type" => 'ItemList',
            "ItemListElement" => $currencyRates->map(function ($currencyRate) {
                return [
                    "@type" => "ExchangeRateSpecification",
                    "currency" => $currencyRate['source']['id'],
                    "currentExchangeRate" => [
                        "@type" => "UnitPriceSpecification",
                        "price" => $currencyRate['value'],
                        "priceCurrency" => $currencyRate['target']['id'],
                    ],
                ];
            }),
        ]);

        return view('home', ['currencyRates' => $currencyRates]);
    }
}
