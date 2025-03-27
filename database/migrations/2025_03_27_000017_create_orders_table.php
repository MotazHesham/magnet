<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_num')->nullable();
            $table->boolean('store_approval')->default(0);
            $table->string('delivery_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status');
            $table->longText('payment_data')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('shipping_type')->nullable();
            $table->decimal('coupon_discount', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
