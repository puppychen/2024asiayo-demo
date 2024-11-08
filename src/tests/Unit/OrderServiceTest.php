<?php

namespace Tests\Unit;

use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateOrderSuccess()
    {
        $orderService = new OrderService();

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

        $order = $orderService->createOrder($data);

        $this->assertDatabaseHas('orders', ['order_code' => 'A0000001']);
        $this->assertDatabaseHas('orders_twd', ['name' => 'Melody Holiday Inn']);
    }
}