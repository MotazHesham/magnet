<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombinedOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('combined_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_num')->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->longText('shipping_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
