<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{order_code}', [OrderController::class, 'get']);