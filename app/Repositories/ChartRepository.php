<?php

namespace App\Repositories;

use Illuminate\Support\Carbon;


class ChartRepository
{

    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get charts 
     * @param int $subtrack
     */
    public function getCharts($subtrack = 10, $simbol = false)
    {
        $result = $this->model::where('timestamp', '>=', Carbon::now()->subMonths($subtrack)->toDateTimeString());

        if($simbol){
            $result->where('simbol', $simbol);
        } else {
            $result->where('simbol', env('APIDATA_SIMBOL', 'BTCUSD'));
        }
        return $result->get();
    }

    /**
     * Insert Charts
     * @param array
     */
    public function insertChart($chart){

        if(isset($chart['message']) && $chart['message'] == __('notify.chart.uncknow_simbol'))
        {
            return false;
        }

        return $this->model::create([
            'last_price' => $chart['last_price'],
            'simbol' => env('APIDATA_SIMBOL', 'BTCUSD'),
            'timestamp' => Carbon::parse($chart['timestamp'])->toDateTimeString()
        ]);

    }
}
