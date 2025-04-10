<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('otp_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps();
        });
    }
}
