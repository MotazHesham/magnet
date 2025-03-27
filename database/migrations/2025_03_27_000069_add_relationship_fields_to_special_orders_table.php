<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSpecialOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('special_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10508080')->references('id')->on('users');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id', 'store_fk_10508081')->references('id')->on('stores');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_10508084')->references('id')->on('product_categories');
        });
    }
}
