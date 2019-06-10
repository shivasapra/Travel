<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');

            $table->string('universal_pnr')->nullable();
            $table->string('pnr')->nullable();
            $table->string('agency_pcc')->nullable();
            $table->string('airline_ref')->nullable();
            $table->string('total_amount')->nullable();

            $table->string('segment_one_from')->nullable();
            $table->string('segment_two_from')->nullable();
            $table->string('segment_one_to')->nullable();
            $table->string('segment_two_to')->nullable();
            $table->string('segment_one_carrier')->nullable();
            $table->string('segment_two_carrier')->nullable();
            $table->string('segment_one_flight')->nullable();
            $table->string('segment_two_flight')->nullable();
            $table->string('segment_one_class')->nullable();
            $table->string('segment_two_class')->nullable();
            $table->string('segment_one_departure_date')->nullable();
            $table->string('segment_two_departure_date')->nullable();
            $table->string('segment_one_departure_time')->nullable();
            $table->string('segment_two_departure_time')->nullable();
            $table->string('segment_one_arrival_date')->nullable();
            $table->string('segment_two_arrival_date')->nullable();
            $table->string('segment_one_arrival_time')->nullable();
            $table->string('segment_two_arrival_time')->nullable();

            $table->string('flight_remarks')->nullable();
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
        Schema::dropIfExists('flights');
    }
}
