@extends('layouts.app')

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h1 class="title">
                            Primary title
                        </h1>
                        <h2 class="subtitle">
                            Primary subtitle
                        </h2>
                    </div>
                    <div class="column">
                        <div class="box tw-shadow-lg has-background-primary has-text-white">

                                <p>1 usd = 12 gaysd</p>
                                <p>1 ves = 10000 brazil</p>
                                <p>1 cock = 1 vagene</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <p>Dile adiós a todos los promedios, a los animales raros y a las casas de cambio que nadie sabe dónde quedan, la tasa actual es:</p>
            <p>1USD = 3,349 VES</p>
            <p>¿De dónde se obtiene el precio? de la simple oferta y demanda, es decir, de las transacciones reales completadas del sitio localbitcoins.com</p>
            <p>Durante las últimas 24 horas se han completado transacciones de compra/venta por un costo total de:</p>
            <p>4,131,150,700.72 Bolivares</p>
            <p>1,186,322.64 Dolares</p>
            <v-chart :data='{!!  json_encode($data) !!}'></v-chart>
        </div>
    </section>
@endsection