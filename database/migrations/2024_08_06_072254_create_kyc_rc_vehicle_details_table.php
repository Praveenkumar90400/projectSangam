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
        Schema::create('kyc_rc_vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->date('manufactured_date')->nullable(); //make string
            $table->foreignId('rc_details_id')->nullable()->constrained('rc_details');
            $table->string('variant')->nullable();
            $table->string('category')->nullable();
            $table->text('category_description')->nullable(); 
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->text('maker_description')->nullable(); 
            $table->string('maker_model')->nullable();
            $table->string('body_type')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('color')->nullable();
            $table->integer('cubic_capacity')->nullable(); 
            $table->integer('gross_weight')->nullable(); 
            $table->integer('number_of_cylinders')->nullable(); 
            $table->integer('seating_capacity')->nullable(); 
            $table->integer('wheelbase')->nullable(); 
            $table->integer('unladen_weight')->nullable(); 
            $table->integer('standing_capacity')->nullable(); 
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
        Schema::dropIfExists('kyc_rc_vehicle_details');
    }
};
