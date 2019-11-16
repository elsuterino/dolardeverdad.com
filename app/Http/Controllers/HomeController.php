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
//        JsonLd::addValue("mainEntity", [
//            "@type" => "ExchangeRateSpecification",
//            "currency" => "USD",
//            "currentExchangeRate" => [
//                "@type" => "UnitPriceSpecification",
//                "price" => round(getCurrency('VESUSD', 'value'), 2),
//                "priceCurrency" => "VES",
//            ],
//        ]);

        $currenciesToCompare = ['USD', 'EUR', 'COP', 'ARS', 'CLP', 'PEN'];
        JsonLd::addValue("mainEntity", [
            "@type" => 'ItemList',
            "ItemListElement" =>
                array_map(function ($currency) {
                    return [
                        "@type" => "ExchangeRateSpecification",
                        "currency" => $currency,
                        "currentExchangeRate" => [
                            "@type" => "UnitPriceSpecification",
                            "price" => round(getCurrency("VES{$currency}", 'value'), 2),
                            "priceCurrency" => "VES",
                        ],
                    ];
                }, ['USD', 'EUR', 'COP', 'ARS', 'CLP', 'PEN']),
        ]);
        return view('home');
    }
}
