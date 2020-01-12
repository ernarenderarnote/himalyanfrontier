<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->longText('quick_look')->nullable();
            $table->longText('detailed_itinerary')->nullable();
            $table->longText('costs')->nullable();
            $table->longText('cost_include')->nullable();
            $table->longText('cost_exclude')->nullable();
            $table->string('map')->nullable();
            $table->longText('general_information')->nullable();
            $table->longText('activity_points')->nullable();
            $table->longText('highlights')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->enum('hot_deal', ['0', '1'])->nullable();
            $table->enum('fixed_diparture', ['0', '1'])->nullable();
            $table->enum('is_active', ['0', '1'])->nullable();
            $table->longText('feature_img')->nullable();
            $table->longText('gallery_img')->nullable();
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
        Schema::dropIfExists('itineraries');
    }
}
