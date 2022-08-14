<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $endDate = new Carbon(Carbon::now()->toDateTimeString());
        $startDate = new Carbon(Carbon::now()->subYear()->toDateTimeString());
        $all_dates = array();
        while ($startDate->lte($endDate))
        {
            DB::table('bitfinex')->insert([
                'last_price' => mt_rand(10000, 50000),
                'simbol' => env('APIDATA_SIMBOL', 'BTCUSD'),
                'timestamp' =>  $startDate->toDateTimeString()
            ]);
            $startDate->addDay();
        }
    }
}
