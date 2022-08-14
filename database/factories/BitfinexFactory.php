<?php

namespace Database\Factories;

use App\Models\Bitfinex;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bitfinex>
 */
class BitfinexFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bitfinex::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'last_Price' => mt_rand(10000, 50000),
            'simbol' => env('APIDATA_SIMBOL', 'BTCUSD'),
            'timestamp' => now(),
        ];
    }
}
