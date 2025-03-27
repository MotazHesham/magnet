<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('note')->nullable();
            $table->string('variant')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('earn_point')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
