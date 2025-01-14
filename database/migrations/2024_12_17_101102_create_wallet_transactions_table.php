<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id(); 
            $table->integer('user_id'); 
            $table->string('payment_id')->unique(); 
            $table->string('order_id'); 
            $table->decimal('amount', 10, 2); 
            $table->tinyInteger('amount_type')->default(0); 
            $table->tinyInteger('payment_status')->comment('0: failed, 1: success, 2: pending');
            $table->integer('transaction_id')->unique(); 
            $table->tinyInteger('payment_mode'); 
            $table->text('payment_details')->nullable(); 
            $table->timestamp('response_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
