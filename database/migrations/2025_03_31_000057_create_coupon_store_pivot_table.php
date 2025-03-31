<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponStorePivotTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_store', function (Blueprint $table) {
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id', 'coupon_id_fk_10508170')->references('id')->on('coupons')->onDelete('cascade');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id', 'store_id_fk_10508170')->references('id')->on('stores')->onDelete('cascade');
        });
    }
}
