<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerScratchesTable extends Migration
{
    public function up()
    {
        Schema::create('customer_scratches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('used')->default(0);
            $table->date('expire_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
