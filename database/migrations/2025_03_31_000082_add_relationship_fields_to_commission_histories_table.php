<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommissionHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('commission_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id', 'store_fk_10516160')->references('id')->on('stores');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_10516161')->references('id')->on('orders');
            $table->unsignedBigInteger('order_detail_id')->nullable();
            $table->foreign('order_detail_id', 'order_detail_fk_10516162')->references('id')->on('order_details');
        });
    }
}
