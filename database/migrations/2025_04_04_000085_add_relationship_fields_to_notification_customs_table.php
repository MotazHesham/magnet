<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNotificationCustomsTable extends Migration
{
    public function up()
    {
        Schema::table('notification_customs', function (Blueprint $table) {
            $table->unsignedBigInteger('notification_type_id')->nullable();
            $table->foreign('notification_type_id', 'notification_type_fk_10522309')->references('id')->on('notification_types');
        });
    }
}