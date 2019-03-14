<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ app()->version() }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="tw-min-h-screen">
    <nav class="navbar is-primary">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="navbar-item">
                    <img src="{{ asset('favicons/favicon-32x32.png') }}" alt="logo" width="28" height="28">
                    <span>Dolardepig</span>
                </a>

                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="navbar-menu" id="navMenu">
                <div class="navbar-start">
                    <a class="navbar-item " href="#">Maybe</a>
                    <a class="navbar-item " href="#">Maybe not</a>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Calculators
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                                Gaytulator
                            </a>
                            <a class="navbar-item">
                                Paytulator
                            </a>
                            <a class="navbar-item">
                                Gipsylator
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item">
                                Report an issue
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navbar-end">
                    <a class="navbar-item " href="#">Maybe</a>
                    <a class="navbar-item " href="#">Maybe yes</a>
{{--                    @include('layouts.auth')--}}
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>