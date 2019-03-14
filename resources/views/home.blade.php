<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="yandex-verification" content="0c762508645a7168" />

    <title>Dólar de Verdad – El verdadero precio del dólar en Venezuela</title>
    <meta name="description"
          content="Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones">

    {{-- titles --}}
    <meta property="og:site_name" content="Dólar de Verdad"/>
    <meta property="og:title" content="El verdadero precio del dólar en Venezuela"/>
    <meta property="twitter:title" content="El verdadero precio del dólar en Venezuela"/>
    <title>Dólar de Verdad - El verdadero precio del dólar en Venezuela</title>

    {{-- descriptions --}}
    <meta property="og:description"
          content="Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones"/>
    <meta property="twitter:description"
          content="Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones"/>
    <meta name="description"
          content="Precio del dólar en Venezuela basado en transacciones completadas y no en especulaciones"/>

    {{-- image --}}
    <meta property="og:image" content="/favicons/android-chrome-512x512.png"/>
    <meta property="twitter:image" content="/favicons/android-chrome-512x512.png"/>


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

    <style>
        .bg:before {
            background: url({{ asset('image/saving-a-dollar-coin.svg') }}) no-repeat center bottom;
            background-size: cover;
            /*mix-blend-mode: multiply;*/
            /*filter: grayscale(100%);*/
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .bg {
            opacity: 0.99;
        }

        .open-sans {
            font-family: 'Open Sans', arial, sans-serif;
        }

        .roboto {
            font-family: 'Roboto', arial, sans-serif;
        }
    </style>
</head>
<body class="open-sans">
<div id="app" class="min-h-screen bg-blue-darker bg">
    <section class="container mx-auto pt-12 md:pt-32 p-4">

        <p class="pb-4 text-5xl font-bold text-white roboto">
            Dolar de verdad
        </p>
        <div class="md:flex">
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
                        <span class="text-blue-light text-lg">{{ number_format(Cache::get('latest:localhost:moved-today:ves')) }}</span>
                        Bolivares
                    </p>

                    <p class="pb-4">
                        <span class="text-blue-light text-lg">{{ number_format(Cache::get('latest:localhost:moved-today:usd')) }}</span>
                        Dolares
                    </p>
                </div>

            </div>

            <div class="md:w-1/2">
                <v-chart :data='{!! json_encode(Cache::get('chart-dataset')) !!}'></v-chart>
            </div>
        </div>

    </section>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>

</script>
</body>
</html>
