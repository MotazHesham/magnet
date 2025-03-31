<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScratchesTable extends Migration
{
    public function up()
    {
        Schema::create('scratches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('discount_type');
            $table->decimal('discount', 15, 2);
            $table->integer('expiration_days');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
