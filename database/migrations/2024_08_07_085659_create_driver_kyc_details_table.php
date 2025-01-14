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
        Schema::create('driver_kyc_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->nullable()->constrained('driving_license_details');//make unique
            $table->string('document_type')->nullable();
            $table->unsignedBigInteger('document_number')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('email')->nulable();
            $table->unsignedBigInteger('mobile')->nullable();//make string
            $table->string('image')->nullable();
            $table->date('date_of_birth')->nullable();//make string
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->string('care_of')->nullable();
            $table->string('house')->nullable();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('landmark')->nullable();
            $table->string('locality')->nullable();
            $table->string('post_office')->nullable();
            $table->string('state')->nullable();
            $table->integer('pincode')->nullable();//make string
            $table->string('country')->nullable();
            $table->string('vtc_name')->nullable();
            $table->string('photo_base_64')->nullable();
            $table->string('xml_base_64')->nullable();
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
        Schema::dropIfExists('driver_kyc_details');
    }
};
