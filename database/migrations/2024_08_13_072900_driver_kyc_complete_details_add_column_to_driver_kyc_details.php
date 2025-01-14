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
        Schema::table('driver_kyc_details', function (Blueprint $table) {
            $table->foreignId('driver_id')->nullable()->constrained('driving_license_details');
            $table->tinyInteger('kyc_status')->default(0);
            $table->date('kyc_approval_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driver_kyc_details', function (Blueprint $table) {
            //
        });
    }
};
