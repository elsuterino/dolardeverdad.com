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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <style>
        [v-cloak] {
            display: none
        }
    </style>

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
<body class="open-sans overflow-y-scroll">
<div id="app" class="min-h-screen bg-gray-900 text-white" v-cloak>
    <main-page :rates="{{ json_encode($currencyRates) }}"></main-page>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>














