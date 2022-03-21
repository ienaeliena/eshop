<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFnameLnamePhoneNullableOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fname')->unsigned()->nullable()->change();
            $table->string('lname')->unsigned()->nullable()->change();
            $table->string('phone')->unsigned()->nullable()->change();
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
            $table->string('fname')->unsigned()->nullable(false)->change();
            $table->string('lname')->unsigned()->nullable(false)->change();
            $table->string('phone')->unsigned()->nullable(false)->change();
        });
    }
}
