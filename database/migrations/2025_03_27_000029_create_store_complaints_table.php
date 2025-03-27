<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreComplaintsTable extends Migration
{
    public function up()
    {
        Schema::create('store_complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
