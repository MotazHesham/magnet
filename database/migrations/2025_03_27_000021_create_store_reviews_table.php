<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('store_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate')->nullable();
            $table->longText('review')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
