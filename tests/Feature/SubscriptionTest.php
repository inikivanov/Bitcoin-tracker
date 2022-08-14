<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Subscription;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test create subscription witout form data
     *
     * @return void
     */
    public function test_create_new_subscription_without_form_data()
    {
        $response = $this->post('/api/subscribe-for-notifications');

        $response->assertStatus(422);
    }

    /**
     * Test create subscription with valid data
     * 
     * @return void
     */
    public function test_create_new_subscription()
    {
        $response = $this->post('/api/subscribe-for-notifications',[
            'email' => 'somemail@email.com', 
            'amount' => '24000'
        ]);

        $response->assertStatus(200);
    }
    
    /**
     * Test create subscription with awready exists email
     *
     * @return void
     */
    public function test_check_create_subscription_with_used_email()
    {

        $row = Subscription::factory()->create([
            'email' => 'somemail@email.com', 
            'amount' => '24000'
        ]);

        $response = $this->post('/api/subscribe-for-notifications',[
            'email' => 'somemail@email.com', 
            'amount' => '24000'
        ]);

        $response->assertStatus(422);

    }

    /**
     * Test Notify
     */


}
