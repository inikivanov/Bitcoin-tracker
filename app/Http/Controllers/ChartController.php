<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ChartRepository;
use App\Models\Bitfinex;


class ChartController extends Controller
{

    private $chart;

    public function __construct(Bitfinex $model)
    {
        $this->chart = new ChartRepository($model);
    }

    /**
     * Get chart
     * @author Ivan Ivanov
     * @return json
     */
    public function __invoke(Request $request)
    {
        //get from db data for chart line
        $response = $this->chart->getCharts();

        //return response
        return response()->json([
            'data' => $response,
            'status' => 'success',
            'message' => ''
        ], 200);   
    }
}
