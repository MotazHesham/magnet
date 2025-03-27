<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('refund_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('reason')->nullable();
            $table->decimal('refund_amount', 15, 2)->nullable();
            $table->boolean('store_approval')->default(0)->nullable();
            $table->boolean('admin_approval')->default(0)->nullable();
            $table->longText('reject_reason')->nullable();
            $table->string('refund_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
