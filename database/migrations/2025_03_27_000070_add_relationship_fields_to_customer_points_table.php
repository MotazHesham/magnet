<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCustomerPointsTable extends Migration
{
    public function up()
    {
        Schema::table('customer_points', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10508192')->references('id')->on('users');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_10508194')->references('id')->on('orders');
            $table->unsignedBigInteger('order_detail_id')->nullable();
            $table->foreign('order_detail_id', 'order_detail_fk_10508195')->references('id')->on('order_details');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_10508196')->references('id')->on('products');
        });
    }
}
