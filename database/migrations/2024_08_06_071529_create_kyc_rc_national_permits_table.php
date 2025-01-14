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
        Schema::create('kyc_rc_national_permits', function (Blueprint $table) {
            $table->id();
            $table->string('issue_by')->nullable(); 
            $table->foreignId('kyc_rc_permit_id')->nullable()->constrained('kyc_rc_permits');
            $table->string('permit_number')->nullable(); 
            $table->string('national_permit_number')->nullable(); 
            $table->date('national_permit_upto')->nullable();//make string 
            $table->string('national_permit_issued_by')->nullable(); 
            $table->date('expiry_date')->nullable();//make string
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
        Schema::dropIfExists('kyc_rc_national_permits');
    }
};
