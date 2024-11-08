<?php

namespace App\Http\Controllers;

use App\Events\OrderSubmitted;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function store(OrderRequest $request)
    {
        event(new OrderSubmitted($request->validated()));

        return response()->json(['status' => 'success'], 200);
    }

    public function get($order_code)
    {
        $order = $this->orderService->getOrderByCode($order_code);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->load('currency');

        return OrderResource::make($order);
    }
}