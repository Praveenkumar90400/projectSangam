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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('module_name')->nullable();
            $table->unsignedBigInteger('module_id');  // Define foreign key column
            $table->foreign('module_id')
                  ->references('id')
                  ->on('modules')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  // Add onUpdate action            
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
        Schema::dropIfExists('permissions');
    }
};
