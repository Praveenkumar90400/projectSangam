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
  use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->bigInteger('role_id')->unsigned()->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->tinyInteger('status')->default(1);
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->bigInteger('phone')->unsigned()->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable();
            }
            if (!Schema::hasColumn('users', 'pincode')) {
                $table->integer('pincode')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
            $table->dropColumn('status');
            $table->dropColumn('phone');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('pincode');
            $table->dropColumn('address');
        });
    }
}
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
