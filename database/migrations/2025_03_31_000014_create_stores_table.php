<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_type')->nullable();
            $table->string('store_name');
            $table->longText('description')->nullable();
            $table->string('address')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('store_email')->nullable();
            $table->string('domain')->nullable();
            $table->string('identity_num')->nullable();
            $table->string('commerical_register_num')->nullable();
            $table->string('tax_number')->nullable();
            $table->float('rating', 4, 2)->nullable();
            $table->decimal('admin_to_pay', 15, 2)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
