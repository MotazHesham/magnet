<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryStorePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_category_store', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id', 'store_id_fk_10508104')->references('id')->on('stores')->onDelete('cascade');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_10508104')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
}
