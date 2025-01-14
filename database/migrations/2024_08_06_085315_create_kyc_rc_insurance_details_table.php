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
        Schema::create('kyc_rc_insurance_details', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number')->nullable();
            $table->foreignId('rc_details_id')->nullable()->constrained('rc_details');
            $table->string('company')->nullable();
            $table->date('expiry_date')->nullable();//make string
            $table->text('kyc_vehicle_challan_details')->nullable();
            $table->text('kyc_vehicle_black_list_details')->nullable();
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
        Schema::dropIfExists('kyc_rc_insurance_details');
    }
};
