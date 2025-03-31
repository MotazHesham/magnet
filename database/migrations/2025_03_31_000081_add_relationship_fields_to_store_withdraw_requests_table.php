<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStoreWithdrawRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('store_withdraw_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id', 'store_fk_10516152')->references('id')->on('stores');
        });
    }
}
