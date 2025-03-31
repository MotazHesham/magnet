<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->decimal('amount', 15, 2);
            $table->string('payment_status');
            $table->longText('payment_data')->nullable();
            $table->string('payment_method');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
