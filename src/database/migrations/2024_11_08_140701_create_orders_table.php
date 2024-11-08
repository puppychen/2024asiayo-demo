<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique()
                 ->comment('傳入的id編號');
            $table->unsignedBigInteger('currency_id')
                ->comment('關聯currencies表的id');
            $table->string('currency_type')
                ->comment('關聯currencies表的type');
            $table->timestamps();

            $table->index(['currency_id', 'currency_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
