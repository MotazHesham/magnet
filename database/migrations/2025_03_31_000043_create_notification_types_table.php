<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTypesTable extends Migration
{
    public function up()
    {
        Schema::create('notification_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type');
            $table->string('type');
            $table->string('name');
            $table->longText('default_text');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
