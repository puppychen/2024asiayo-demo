<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_code', 'currency_id', 'currency_type'];

    public function currency()
    {
        return $this->morphTo();
    }
}
