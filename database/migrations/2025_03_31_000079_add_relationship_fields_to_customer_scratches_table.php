<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCustomerScratchesTable extends Migration
{
    public function up()
    {
        Schema::table('customer_scratches', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10515356')->references('id')->on('users');
            $table->unsignedBigInteger('scratch_id')->nullable();
            $table->foreign('scratch_id', 'scratch_fk_10515357')->references('id')->on('scratches');
        });
    }
}
