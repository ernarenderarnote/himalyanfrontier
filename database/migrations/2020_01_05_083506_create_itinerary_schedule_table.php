<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItineraryScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('itinerary_id')->unsigned();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itinerary_schedule');
    }
}
