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
        Schema::create('kyc_rc_permits', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date')->nullable();//make string
            $table->foreignId('rc_details_id')->nullable()->constrained('rc_details');
            $table->string('permit_number')->nullable(); 
            $table->date('expiry_date')->nullable();//make string
            $table->string('type')->nullable(); 
            $table->date('permit_valid_from')->nullable();//make string
            $table->date('permit_valid_upto')->nullable();//make string
            $table->text('kyc_rc_permit_data')->nullable();
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
        Schema::dropIfExists('kyc_rc_permits');
    }
};
