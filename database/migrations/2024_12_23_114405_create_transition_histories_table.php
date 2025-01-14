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
        Schema::create('transition_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); 
            $table->double('amount', 10, 2); 
            $table->string('payment_id'); 
            $table->string('order_id'); 
            $table->string('payment_status'); 
            $table->string('transaction_id'); 
            $table->string('payment_gateway'); 
            $table->text('payment_details');
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
        Schema::dropIfExists('transition_histories');
    }
};
