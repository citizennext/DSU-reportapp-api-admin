<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDepartamentRelationshipToUnitateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unitati', function (Blueprint $table) {
            $table->unsignedInteger('departament_id')->nullable();
        });

        Schema::table('unitati', function (Blueprint $table) {
            $table->foreign('departament_id')->references('id')->on('departamente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unitati', function (Blueprint $table) {
            $table->dropColumn('departament_id');
        });
    }
}
