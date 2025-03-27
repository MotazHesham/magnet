<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_10500610')->references('id')->on('products');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10500614')->references('id')->on('users');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id', 'store_fk_10500616')->references('id')->on('stores');
        });
    }
}
