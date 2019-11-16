<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults' => [
            'title' => "Dólar de Verdad – El verdadero precio del dólar en Venezuela", // set false to total remove
            'titleBefore' => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' => 'Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones',
            // set false to total remove
            'separator' => ' - ',
            'keywords' => [],
            'canonical' => false, // Set null for using Url::current(), set false to total remove
            'robots' => 'all', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google' => null,
            'bing' => null,
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title' => 'Dólar de Verdad – El verdadero precio del dólar en Venezuela', // set false to total remove
            'description' => 'Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones',
            // set false to total remove
            'url' => false, // Set null for using Url::current(), set false to total remove
            'type' => 'website',
            'site_name' => 'Dólar de Verdad',
            'images' => [asset('/favicons/android-chrome-512x512.png')],
            'locale' => 'es_VE',
            'locale:alternate' => 'es_ES',
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title' => 'Dólar de Verdad – El verdadero precio del dólar en Venezuela', // set false to total remove
            'description' => 'Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones',
            // set false to total remove
            'url' => false, // Set null for using Url::current(), set false to total remove
            'type' => 'WebPage',
            'images' => ['/favicons/android-chrome-512x512.png'],
            "sameAs" => [
                "https://twitter.com/weworkremotely",
            ],
        ],
    ],
];
