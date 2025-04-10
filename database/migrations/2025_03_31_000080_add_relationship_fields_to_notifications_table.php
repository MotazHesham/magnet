<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNotificationsTable extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('notification_type_id')->nullable();
            $table->foreign('notification_type_id', 'notification_type_fk_10516149')->references('id')->on('notification_types');
            $table->unsignedBigInteger('notification_custom_id')->nullable();
            $table->foreign('notification_custom_id', 'notification_custom_fk_102324149')->references('id')->on('notification_customs');
        });
    }
}
