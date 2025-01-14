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
        Schema::create('driving_license_details', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->nullable();
            $table->string('license_holder')->nullable();
            $table->date('date_of_birth')->nullable();//make string
            $table->string('image')->nullable();
            $table->string('rto_name')->nullable();
            $table->string('transport_from')->nullable();
            $table->text('address')->nullable();
            $table->date('hill_valid_till')->nullable();//make string
            $table->tinyInteger('status')->default(0);
            $table->string('transport_to')->nullable();
            $table->date('last_endorsed_date')->nullable();//make string
            $table->date('non_transport_from')->nullable();//make string
            $table->date('non_transport_to')->nullable();//make string
            $table->string('source')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('dependent_name')->nullable();
            $table->string('old_new_di_number')->nullable();
            $table->integer('pincode')->nullable();//make string
            $table->string('last_endorsed_office')->nullable();
            $table->string('last_transaction')->nullable();
            $table->json('class_of_vehicle')->nullable();
            $table->string('state')->nullable();
            $table->date('issue_date')->nullable();//make string
            $table->date('hazardous_valid_till')->nullable();//make string
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
        Schema::dropIfExists('driving_license_details');
    }
};
