<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('weight', 15, 2)->nullable();
            $table->string('tags')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('refundable')->default(0)->nullable();
            $table->boolean('featured')->default(0)->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->boolean('published')->default(0)->nullable();
            $table->decimal('purchase_price', 15, 2);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('discount', 15, 2)->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('current_stock')->nullable();
            $table->string('sku')->nullable();
            $table->boolean('variant_product')->default(0)->nullable();
            $table->longText('attributes')->nullable();
            $table->longText('choice_options')->nullable();
            $table->longText('colors')->nullable();
            $table->integer('num_of_sale')->nullable();
            $table->float('rating', 4, 2)->nullable();
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
