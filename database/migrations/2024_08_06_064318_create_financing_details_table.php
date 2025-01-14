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
        Schema::create('financing_details', function (Blueprint $table) {
            $table->id();
            $table->string('financier')->nullable();
            $table->foreignId('rc_details_id')->nullable()->constrained('rc_details');
            $table->string('financed')->nullable();
            $table->date('financing_status_as_on')->nullable();//make string
            $table->string('pucc_number')->nullable();
            $table->date('pucc_upto')->nullable();//make string
            $table->unsignedBigInteger('mobile_number')->nullable();//make string
            $table->integer('pincode')->nullable();//make string
            $table->date('vehicle_tax_upto')->nullable();//make string
            $table->string('rc_standard_cap')->nullable();
            $table->boolean('non_use_status')->default(false);//make string
            $table->date('non_use_from')->nullable();//make string
            $table->date('non_use_to')->nullable();//make string
            $table->boolean('is_commercial')->default(false);//make string
            $table->string('registered_at')->nullable();
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
        Schema::dropIfExists('financing_details');
    }
};
