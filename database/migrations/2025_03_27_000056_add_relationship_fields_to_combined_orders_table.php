<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCombinedOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('combined_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10500622')->references('id')->on('users');
        });
    }
}
