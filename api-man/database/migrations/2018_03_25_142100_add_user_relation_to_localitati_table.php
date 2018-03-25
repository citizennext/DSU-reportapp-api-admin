<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserRelationToLocalitatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('localitati', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
        });

        Schema::table('localitati', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('localitati', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
