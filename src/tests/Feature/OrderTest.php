<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Events\OrderSubmitted;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testOrderCreationSuccess()
    {

        $data = [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => '2050',
            'currency' => 'TWD',
        ];

        $response = $this->postJson('/api/orders', $data);

        $response->assertStatus(200)
                 ->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('orders', ['order_code' => 'A0000001']);
        $this->assertDatabaseHas('orders_twd', ['name' => 'Melody Holiday Inn']);

        $response = $this->getJson('/api/orders/A0000001');

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'id' => 'A0000001',
                         'name' => 'Melody Holiday Inn',
                         'address' => [
                             'city' => 'taipei-city',
                             'district' => 'da-an-district',
                             'street' => 'fuxing-south-road',
                         ],
                         'price' => '2050',
                         'currency' => 'TWD',
                     ],
                 ]);
    }

    public function testOrderCreationValidationFailure()
    {
        $data = [];

        $response = $this->postJson('/api/orders', $data);

        $response->assertStatus(422);
    }
}