<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCouponUsagesTable extends Migration
{
    public function up()
    {
        Schema::table('coupon_usages', function (Blueprint $table) {
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id', 'coupon_fk_10500756')->references('id')->on('coupons');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10500757')->references('id')->on('users');
            $table->unsignedBigInteger('combined_order_id')->nullable();
            $table->foreign('combined_order_id', 'combined_order_fk_10508172')->references('id')->on('combined_orders');
        });
    }
}
