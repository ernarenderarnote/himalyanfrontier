<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->string("customer_name")->nullable();
            $table->string("email")->nullable();
            $table->string("invoice_due_date")->nullable();
            $table->string("booking_handled_by")->nullable();
            $table->string("travel_date")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("tax_details")->nullable();
            $table->string("travel_location")->nullable();
            $table->string("travel_type")->nullable();
            $table->string("customer_type")->nullable();
            $table->string("currency")->nullable();
            $table->string("service_name")->nullable();
            $table->string("no_of_persons")->nullable();
            $table->string("per_person_price")->nullable();
            $table->string("tax")->nullable();
            $table->string("tour_itinerary")->nullable();
            $table->string("inclusion")->nullable();
            $table->string("exclusion")->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
