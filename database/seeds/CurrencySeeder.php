<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Currency::create([
            'id' => 'VES',
            'name' => 'Venezuelan dollar',
            'name_es' => 'Venezuelan bolívar soberano',
            'prefix' => 'Bs. ',
            'decimals' => 2
        ]);

        \App\Currency::create([
            'id' => 'ARS',
            'name' => 'Argentine Peso',
            'name_es' => 'Peso Argentino',
            'decimals' => 2
        ]);

        \App\Currency::create([
            'id' => 'CLP',
            'name' => 'Peso chileno',
            'name_es' => 'Peso chileno',
            'decimals' => 2
        ]);

        \App\Currency::create([
            'id' => 'COP',
            'name' => 'Peso Colombiano',
            'name_es' => 'Peso Colombiano',
            'decimals' => 2
        ]);

        \App\Currency::create([
            'id' => 'EUR',
            'name' => 'Euro',
            'name_es' => 'Euro',
            'decimals' => 2,
            'prefix' => '€ '
        ]);

        \App\Currency::create([
            'id' => 'PEN',
            'name' => 'Sol Peruano',
            'name_es' => 'Sol Peruano',
            'decimals' => 2,
        ]);

        \App\Currency::create([
            'id' => 'USD',
            'name' => 'US Dollar',
            'name_es' => 'Dólar estadounidense',
            'decimals' => 2,
            'prefix' => '$ '
        ]);
    }
}
