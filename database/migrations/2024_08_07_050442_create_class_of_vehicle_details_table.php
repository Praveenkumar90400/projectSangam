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
        Schema::create('class_of_vehicle_details', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('driver_id')->nullable()->constrained('driving_license_details');
            $table->string('cov_category')->nullable();
            $table->date('cov_issue_date')->nullable();
            $table->string('class_of_vehicle')->nullable();
            $table->string('state')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('hazardous_valid_till')->nullable();
            $table->string('initial_issuing_office')->nullable();
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
        Schema::dropIfExists('class_of_vehicle_details');
    }
};
