<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryStateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sortname');
            $table->string('name');
            $table->integer('phonecode');
            $table->timestamps();
        });
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('country_id');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
    }
}
