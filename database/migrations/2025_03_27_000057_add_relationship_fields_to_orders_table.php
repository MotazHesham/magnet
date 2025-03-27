<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('combined_order_id')->nullable();
            $table->foreign('combined_order_id', 'combined_order_fk_10500627')->references('id')->on('combined_orders');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10500629')->references('id')->on('users');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id', 'store_fk_10500633')->references('id')->on('stores');
        });
    }
}
