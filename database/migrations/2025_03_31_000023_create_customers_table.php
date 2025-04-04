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
            $table->decimal('wallet_balance', 15, 2)->nullable();
            $table->integer('points')->default(0)->nullable();
            $table->boolean('can_scratch')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
