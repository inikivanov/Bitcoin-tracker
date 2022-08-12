<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ChartService
{
    /**
     * Get data from BITFINEX
     * 
     * @return json 
     */
    public function getData()
    {
        return Http::get('https://api.bitfinex.com/v1/pubticker/' .env('APIDATA_SIMBOL', 'BTCUSD'));
    }

}
