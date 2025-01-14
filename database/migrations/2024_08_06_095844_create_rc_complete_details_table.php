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
        Schema::create('rc_complete_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rc_details_id')->nullable()->constrained('rc_details');
            $table->string('state_code')->nullable();
            $table->string('serial_code')->nullable();
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
        Schema::dropIfExists('rc_complete_details');
    }
};
