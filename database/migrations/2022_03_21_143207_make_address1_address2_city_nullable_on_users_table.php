<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAddress1Address2CityNullableOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address1')->unsigned()->nullable()->change();
            $table->string('address2')->unsigned()->nullable()->change();
            $table->string('city')->unsigned()->nullable()->change();
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
            $table->string('address1')->unsigned()->nullable(false)->change();
            $table->string('address2')->unsigned()->nullable(false)->change();
            $table->string('city')->unsigned()->nullable(false)->change();
        });
    }
}
