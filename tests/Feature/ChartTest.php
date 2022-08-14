<?php

namespace Tests\Feature;

use App\Models\Bitfinex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChartTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test return from api/chart url
     *
     * @return void
     */
    public function test_retrive_charts_data_successfully()
    {
        $response = $this->get('/api/chart');

        $response->assertStatus(200);
    }

    /**
     * Test console command used from job schedule
     * 
     * return void
     */

    public function test_console_command_runned_from_job_in_application()
    {
        $this->artisan('api:data-notify')->assertSuccessful();
    }

    /**
     * Insert New chart data
     * 
     * return void
     */
    public function test_insert_new_chart_data_bitfinex_table()
    {
        $chart = Bitfinex::factory()->create();
 
        $this->assertModelExists($chart);
    }

}
