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
        Schema::table('driving_license_details', function (Blueprint $table) {
            $table->string('cov_category')->nullable();
            $table->date('cov_issue_date')->nullable();
            $table->string('class_of_vehicle')->nullable();
            $table->string('state')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('hazardous_valid_till')->nullable();
            $table->string('initial_issuing_office')->nullable();
            $table->tinyInteger('kyc_completed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driving_license_details', function (Blueprint $table) {
            //
        });
    }
};
