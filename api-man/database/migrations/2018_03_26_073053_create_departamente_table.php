<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nume');
            $table->string('descriere')->nullable();
            $table->string('adresa')->nullable();
            $table->string('cod_postal')->nullable();
            $table->string('localitate')->nullable();
            $table->string('judet')->nullable();
            $table->string('telefon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamente');
    }
}
