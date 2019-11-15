<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        JsonLd::addValue("mainEntity", [
            "@type" => "ExchangeRateSpecification",
            "currency" => "USD",
            "currentExchangeRate" => [
                "@type" => "UnitPriceSpecification",
                "price" => number_format(Cache::get('latest:ves-local-coinbase')),
                "priceCurrency" => "VES",
            ],
        ]);

        return view('home');
    }
}
