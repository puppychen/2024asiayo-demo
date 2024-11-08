<?php

namespace App\Models\Base;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class BaseOrderCurrency extends Model
{
    protected $fillable = ['name', 'address', 'price'];
    protected $casts = [
        'address' => 'array',
    ];

    public function order()
    {
        return $this->morphOne(Order::class, 'currency');
    }
}