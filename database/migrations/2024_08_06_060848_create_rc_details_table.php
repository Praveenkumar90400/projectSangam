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
        Schema::create('rc_details', function (Blueprint $table) {
            $table->id();
            $table->string('state_code')->nullable(); 
            $table->integer('district_code')->nullable(); 
            $table->string('serial_code')->nullable(); 
            $table->integer('unique_code')->nullable();  
            $table->date('rc_issue_date')->nullable();//make string
            $table->string('vehicle_image')->nullable(); 
            $table->date('expiry_date')->nullable();//make string
            $table->string('rc_status')->nullable();
            $table->string('emission_norms_type')->nullable();
            $table->string('serial')->nullable(); 
            $table->string('rc_category');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rc_details');
    }
};
