<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductComplaintsTable extends Migration
{
    public function up()
    {
        Schema::create('product_complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
