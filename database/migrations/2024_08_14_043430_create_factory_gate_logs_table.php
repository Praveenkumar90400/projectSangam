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
        Schema::create('factory_gate_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('factory_id')->nullable();
            $table->foreignId('gate_id')->nullable()->constrained('factory_gates');
            $table->foreignId('vehicle_id')->nullable()->constrained('rc_details');
            $table->foreignId('driver_id')->nullable()->constrained('driving_license_details');
            $table->integer('user_id')->nullable();
            $table->timestamp('in_time')->nullable();
            $table->timestamp('out_time')->nullable();
            $table->integer('exit_gate')->nullable();
            $table->integer('exit_driver_id')->nullable();
            $table->integer('exit_user_id')->nullable();
            $table->text('entry_remark')->nullable();
            $table->text('exit_remark')->nullable();
            $table->decimal('entry_weight', 10, 2)->nullable();
            $table->decimal('exit_weight', 10, 2)->nullable();
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
        Schema::dropIfExists('factory_gate_logs');
    }
};
