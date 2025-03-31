<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('commission_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('admin_commission', 15, 2);
            $table->decimal('store_earning', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
