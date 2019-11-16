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

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">


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
<body class="open-sans text-lg text-blue-lighter md:text-xl bg-blue-800 bg">
    <div class="container mx-auto">
        <nav class="flex items-center justify-between flex-wrap p-6">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <img class="fill-current h-8 w-8 mr-2" alt="Dolardeverdad" src="/image/saving-a-dollar-coin.svg">
                <span class="font-semibold text-xl tracking-tight">Dolar de Verdad</span>
            </div>
        </nav>
    </div>
    <section class="container mx-auto md:mt-8 px-2">
        <div id="app" class="md:flex">
            <div class="md:w-1/2 px-1">
                <div>
                    <div class="mb-4">
                        <p class="">
                                    Dile adiós a todos los promedios, a los animales raros y a las casas de cambio que nadie sabe
                                    dónde quedan, la tasa de verdad para las monedas mas populares es:
                        </p>
                    </div>
                    <div class="flex-col border border-blue-700 rounded-lg mx-4 mt-2 mb-4 px-2">
                        <div class="flex justify-between border-b border-blue-800 p-1 m-1">  
                            <div>
                                <p class="text-2xl text-blue-light font-bold roboto">
                                    1
                                    <span class="text-lg">USD</span> = {{ number_format(getCurrency('VESUSD', 'value'), 0, ',', '.') }}
                                    <span class="text-lg">VES</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img class="flag" alt="Dolar estadounidense" src="https://www.currencyexchangetoday.com/images/currency/USD.svg">
                            </div> 
                        </div>  
                        <div class="flex justify-between border-b border-blue-800 p-1 m-1">  
                            <div>
                                <p class="text-2xl text-blue-light font-bold roboto">
                                    1
                                    <span class="text-lg">EUR</span> = {{ number_format(getCurrency('VESEUR', 'value'), 0, ',', '.') }}
                                    <span class="text-lg">VES</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img class="flag" alt="Euro" src="https://www.currencyexchangetoday.com/images/currency/EUR.svg">
                            </div> 
                        </div>
                        <div class="flex justify-between border-b border-blue-800 p-1 m-1">  
                            <div>
                                <p class="text-2xl text-blue-light font-bold roboto">
                                    1
                                    <span class="text-lg">ARS</span> = {{ number_format(getCurrency('VESARS', 'value'), 1, ',', '.') }}
                                    <span class="text-lg">VES</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img class="flag" alt="Peso Argentino" src="https://www.currencyexchangetoday.com/images/currency/ARS.svg">
                            </div> 
                        </div>  
                        <div class="flex justify-between border-b border-blue-800 p-1 m-1">  
                            <div>
                                <p class="text-2xl text-blue-light font-bold roboto">
                                    1
                                    <span class="text-lg">CLP</span> = {{ number_format(getCurrency('VESCLP', 'value'), 2, ',', '.') }}
                                    <span class="text-lg">VES</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img class="flag" alt="Peso Chileno" src="https://www.currencyexchangetoday.com/images/currency/CLP.svg">
                            </div> 
                        </div>
                        <div class="flex justify-between border-b border-blue-800 p-1 m-1">  
                            <div>
                                <p class="text-2xl text-blue-light font-bold roboto">
                                    1
                                    <span class="text-lg">COP</span> = {{ number_format(getCurrency('VESCOP', 'value'), 2, ',', '.') }}
                                    <span class="text-lg">VES</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img class="flag" alt="Peso Colombiano" src="https://www.currencyexchangetoday.com/images/currency/COP.svg">
                            </div> 
                        </div>  
                        <div class="flex justify-between p-1 m-1">  
                            <div>
                                <p class="text-2xl text-blue-light font-bold roboto">
                                    1
                                    <span class="text-lg">PEN</span> = {{ number_format(getCurrency('VESPEN', 'value'), 0, ',', '.') }}
                                    <span class="text-lg">VES</span> 
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img class="flag" alt="Sol Peruano" src="https://www.currencyexchangetoday.com/images/currency/PEN.svg">
                            </div> 
                        </div>                                              
                    </div>
                    
                    <div class="pb-4">
                        <p class="pb-4  leading-normal">
                            ¿De dónde se obtiene el precio? de la simple oferta y demanda, es decir, de las transacciones
                            reales completadas del sitio
                            <a href="https://localbitcoins.com/es/?ch=ykb7" class="text-blue hover:text-blue-lighter">
                                localbitcoins.com
                            </a>
                        </p>

                        <p class="pb-4">
                            Durante las últimas 24 horas se han completado transacciones de compra y venta por un costo total de:
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
            </div>
            <div class="md:w-1/2 px-1 md:ml-5 md:mt-2">
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
                    <div class="inline-flex mb-4">
                        <img class="w-6 h-6" src="https://brave.com/wp-content/uploads/2018/02/brave_icon_512x_twitter.png">
                        <span class="text-sm text-blue-lighter">
                        ¿No te gusta la publicidad? <a href="https://brave.com/dol014" class="mr-1 text-orange-400 hover:text-orange"> Descarga el navegador Brave </a>
                        y navega sin publicidades como esta, manteniendo tu privacidad y con mayor rapidez
                        </span>
                    </div>
                </div>
        </div>
    </section>


    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>














