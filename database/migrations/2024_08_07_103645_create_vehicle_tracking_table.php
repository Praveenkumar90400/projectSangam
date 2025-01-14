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
        Schema::create('vehicle_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained('rc_details');
            $table->foreignId('driver_id')->nullable()->constrained('driving_license_details');
            $table->foreignId('factory_id')->nullable()->constrained('factories');
            $table->integer('gate_number')->nullable();
            $table->timestamp('in_time')->nullable();
            $table->timestamp('out_time')->nullable();
            $table->date('date')->nullable();

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
        Schema::dropIfExists('vehicle_tracking');
    }
};
