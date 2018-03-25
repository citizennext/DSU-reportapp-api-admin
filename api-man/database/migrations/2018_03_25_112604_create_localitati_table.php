<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalitatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localitati', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('judet_id');
            $table->string('slug');
            $table->string('nume');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('localitati', function (Blueprint $table) {
            $table->foreign('judet_id')->references('id')->on('judete')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localitati');
    }
}
