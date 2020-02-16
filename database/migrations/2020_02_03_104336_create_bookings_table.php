<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('itinerary_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->string('booking_id')->nullable();
            $table->string('tracking_booking_id')->nullable();
            $table->longText('name')->nullable();
            $table->longText('email')->nullable();
            $table->longText('mobile')->nullable();
            $table->longText('gender')->nullable();
            $table->longText('height')->nullable();
            $table->longText('weight')->nullable();
            $table->longText('address')->nullable();
            $table->longText('state')->nullable();
            $table->longText('city')->nullable();
            $table->longText('pin_code')->nullable();
            $table->string('source')->nullable();
            $table->string('travelexperiance')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('activity_price')->nullable();
            $table->integer('payment_percentage')->nullable();
            $table->integer('no_of_participants')->nullable();
            $table->string('actual_currency')->nullable();
            $table->double('payment_paid')->nullable();
            $table->double('remaining_payment')->nullable();
            $table->string('booking_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->double('actual_price')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}