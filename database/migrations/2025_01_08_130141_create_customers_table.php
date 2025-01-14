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
            Schema::create('customers', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->string('email',191)->unique();
                $table->string('fullname'); // Full name of the customer
                $table->integer('mobile_no'); // Mobile number as a string with a max length of 10
                $table->boolean('status')->default(true); // Status (active/inactive), default is active
                $table->string('password'); // Password for the customer
                $table->string('image')->nullable(); // Path to the image file
                $table->timestamps(); // Created and updated timestamps
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
