<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $currencyModel = $this->getCurrencyModel($data['currency']);

            $currencyOrder = $currencyModel::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'price' => $data['price'],
            ]);

            $order = Order::create([
                'order_code' => $data['id'],
                'currency_id' => $currencyOrder->id,
                'currency_type' => get_class($currencyOrder),
            ]);

            return $order;
        });
    }

    protected function getCurrencyModel($currency)
    {
        $modelClass = 'App\\Models\\Order' . ucfirst(strtolower($currency));

        if (class_exists($modelClass)) {
            return $modelClass;
        }

        throw new \Exception("Unsupported currency: {$currency}");
    }

    public function getOrderByCode(string $orderCode)
    {
        return Order::where('order_code', $orderCode)->first();
    }
}