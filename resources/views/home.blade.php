<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="yandex-verification" content="0c762508645a7168"/>
    <script data-ad-client="ca-pub-6381837279968330" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    {!! SEO::generate() !!}

    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    {{--<link rel="manifest" href="/site.webmanifest">--}}
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-40405144-9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-40405144-9');
    </script>
</head>
<body class="open-sans">
<div class="min-h-screen bg-blue-500 bg">
    <section class="container mx-auto pt-12 md:pt-32 p-4">

        <p class="pb-4 text-5xl font-bold text-white roboto">
            Dolar de verdad
        </p>
        <div id="app" class="md:flex">
            <div class="md:w-1/2">
                <div class="pb-4 text-blue-lighter">
                    <p class="pb-4 leading-normal">
                        Dile adiós a todos los promedios, a los animales raros y a las casas de cambio que nadie sabe
                        dónde quedan, la tasa actual es:
                    </p>

                    <p class="pb-4 text-5xl text-blue-light font-bold roboto">
                        1<sub class="text-2xl">USD</sub> = {{ number_format(Cache::get('latest:ves-local-coinbase')) }}
                        <sub
                            class="text-2xl">VES</sub>
                    </p>

                    <p class="pb-4  leading-normal">
                        ¿De dónde se obtiene el precio? de la simple oferta y demanda, es decir, de las transacciones
                        reales completadas del sitio
                        <a href="https://localbitcoins.com/es/?ch=ykb7" class="text-blue hover:text-blue-lighter">
                            localbitcoins.com
                        </a>
                    </p>

                    <p class="pb-4">
                        Durante las últimas 24 horas se han completado transacciones de compra/venta por un costo total
                        de:
                    </p>

                    <p class="pb-4">
                        <span
                            class="text-blue-light text-lg">{{ number_format(Cache::get('latest:localhost:moved-today:ves')) }}</span>
                        Bolivares
                    </p>

                    <p class="pb-4">
                        <span
                            class="text-blue-light text-lg">{{ number_format(Cache::get('latest:localhost:moved-today:usd')) }}</span>
                        Dolares
                    </p>
                </div>

            </div>

            <div class="md:w-1/2">
                <v-chart :data='{!! json_encode(Cache::get('chart-dataset')) !!}'></v-chart>
            </div>
        </div>
        <div id="ad">

            <script type="text/javascript">
                amzn_assoc_ad_type = "banner";
                amzn_assoc_marketplace = "amazon";
                amzn_assoc_region = "US";
                amzn_assoc_placement = "assoc_banner_placement_default";
                amzn_assoc_campaigns = "wireless";
                amzn_assoc_banner_type = "category";
                amzn_assoc_p = "48";
                amzn_assoc_isresponsive = "false";
                amzn_assoc_banner_id = "0TJY74H4VE9W4MDG6J82";
                amzn_assoc_width = "728";
                amzn_assoc_height = "90";
                amzn_assoc_tracking_id = "inetvi0c-20";
                amzn_assoc_linkid = "9d18c3020e78550dd6753f37b13e628d";
            </script>
            <script src="//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1"></script>
            <div id="subad" class="flex justify-center text-white text-sm mt-1">
                <div class="inline-flex">
                    <img src="https://brave.com/wp-content/uploads/2018/02/brave_icon_512x_twitter.png" class="h-4 w-4">
                    <a href="https://brave.com/dol014" class="mr-1 text-orange-light hover:text-orange">Brave</a>
                    is a browser that is build on chrome, with attention to privacy, speed and blocking ads like theese.
                </div>
            </div>
        </div>

    </section>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>

</script>
</body>
</html>
