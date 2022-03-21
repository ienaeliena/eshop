<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeStateCountryPincodeNullableOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('state')->unsigned()->nullable()->change();
            $table->string('country')->unsigned()->nullable()->change();
            $table->string('pincode')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('state')->unsigned()->nullable(false)->change();
            $table->string('country')->unsigned()->nullable(false)->change();
            $table->string('pincode')->unsigned()->nullable(false)->change();
        });
    }
}
