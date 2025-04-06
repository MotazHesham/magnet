<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('special_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_num')->nullable();
            $table->string('color')->nullable();
            $table->longText('variations')->nullable();
            $table->longText('description')->nullable();
            $table->string('delivery_status');
            $table->string('offer_price_status');
            $table->string('payment_method')->nullable();
            $table->string('payment_status');
            $table->longText('payment_data')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->decimal('shipping_cost', 15, 2)->nullable();
            $table->decimal('offer_price', 15, 2)->nullable();
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
