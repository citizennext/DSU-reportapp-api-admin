<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserRelationToJudeteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judete', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
        });

        Schema::table('judete', function (Blueprint $table) {
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
        Schema::table('judete', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
