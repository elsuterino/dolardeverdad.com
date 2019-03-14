<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use InfluxDB\Client;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \InfluxDB\Exception
     * @throws \Exception
     */
    public function index()
    {
        return view('home');
    }
}
