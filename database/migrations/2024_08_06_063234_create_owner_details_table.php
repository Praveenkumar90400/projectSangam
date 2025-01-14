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
        Schema::create('owner_details', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name')->nullable();
            $table->foreignId('rc_details_id')->nullable()->constrained('rc_details');
            $table->string('care_of')->nullable(); 
            $table->text('present_address')->nullable(); 
            $table->text('permanent_address')->nullable();
            $table->string('black_list_status')->default(0);//make string
            $table->date('tax_end_date')->nullable(); //make string
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
        Schema::dropIfExists('owner_details');
    }
};
