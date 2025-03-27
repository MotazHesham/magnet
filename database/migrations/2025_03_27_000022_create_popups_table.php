<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
