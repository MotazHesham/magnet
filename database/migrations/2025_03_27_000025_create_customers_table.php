<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('balance', 15, 2)->nullable();
            $table->integer('points')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
