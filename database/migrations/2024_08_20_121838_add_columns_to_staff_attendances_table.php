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
        Schema::table('staff_attendances', function (Blueprint $table) {
            //
            $table->string('punchin_image')->after('punchin')->nullable();
            $table->string('punchout_image')->after('punchout')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_attendances', function (Blueprint $table) {
            //
            $table->dropColumn('punchin_image');
            $table->dropColumn('punchout_image');
        });
    }
};
