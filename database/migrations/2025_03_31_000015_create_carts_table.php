<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('temp_user_uid')->nullable();
            $table->integer('quantity');
            $table->string('note')->nullable();
            $table->string('variant')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
