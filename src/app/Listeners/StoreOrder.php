<?php

namespace App\Listeners;

use App\Events\OrderSubmitted;
use App\Services\OrderService;

class StoreOrder
{
    protected OrderService $orderService;
    /**
     * Create the event listener.
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderSubmitted $event): void
    {
        $this->orderService->createOrder($event->orderData);
    }
}
