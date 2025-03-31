<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPointsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points');
            $table->integer('product_quantity');
            $table->boolean('refunded')->default(0)->nullable();
            $table->boolean('converted')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
