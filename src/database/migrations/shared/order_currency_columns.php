<?php
use Illuminate\Database\Schema\Blueprint;

return function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->json('address')->nullable()
        ->comment('地址');
    $table->decimal('price', 15, 2);
    $table->timestamps();
};