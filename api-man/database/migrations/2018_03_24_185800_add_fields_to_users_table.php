<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenume')->nullable()->after('nume');
            $table->string('telefon_s')->nullable()->after('parola');
            $table->string('telefon_p')->nullable()->after('telefon_s');
            $table->string('adresa')->nullable()->after('telefon_p');
            $table->string('cod_postal')->nullable()->after('adresa');
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
            $table->dropColumn('prenume');
            $table->dropColumn('telefon_s');
            $table->dropColumn('telefon_p');
            $table->dropColumn('adresa');
            $table->dropColumn('cod_postal');
        });
    }
}
