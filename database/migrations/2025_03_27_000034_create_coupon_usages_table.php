<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponUsagesTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('discount', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
