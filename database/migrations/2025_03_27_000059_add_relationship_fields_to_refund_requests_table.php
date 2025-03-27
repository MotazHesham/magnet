<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRefundRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10500642')->references('id')->on('users');
            $table->unsignedBigInteger('special_order_id')->nullable();
            $table->foreign('special_order_id', 'special_order_fk_10513073')->references('id')->on('special_orders');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_10500643')->references('id')->on('orders');
            $table->unsignedBigInteger('order_detail_id')->nullable();
            $table->foreign('order_detail_id', 'order_detail_fk_10500647')->references('id')->on('order_details');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id', 'store_fk_10500648')->references('id')->on('stores');
        });
    }
}
