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
        Schema::create('factory_gates', function (Blueprint $table) {
            $table->id();
            $table->string('gate_nu')->nullable();
            $table->unsignedBigInteger('factory_id')->nullable(); // Add the factory_id column
            $table->foreign('factory_id')->references('id')->on('factories')->onDelete('cascade');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();  
            $table->string('qr_code')->nullable();          
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
        Schema::dropIfExists('factory_gates');
    }
};
