<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            
            $table->string('service_name')->nullable();

            $table->string('airline_name')->nullable();
            $table->string('source')->nullable();
            $table->string('destination')->nullable();
            $table->string('date_of_travel')->nullable();
            $table->string('adult')->nullable();
            $table->string('child')->nullable();
            $table->string('infant')->nullable();
            $table->string('infant_dob')->nullable();
            $table->string('flight_amount')->nullable();
            $table->integer('flight_quantity')->nullable();
            $table->integer('flight_price')->nullable();

            $table->string('name_of_visa_applicant')->nullable();
            $table->string('passport_origin')->nullable();
            $table->string('visa_country')->nullable();
            $table->string('visa_type')->nullable();
            $table->string('visa_charges')->nullable();
            $table->string('service_charge')->nullable();
            $table->string('visa_amount')->nullable();

            $table->string('hotel_city')->nullable();
            $table->string('hotel_country')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('check_in_date')->nullable();
            $table->string('check_out_date')->nullable();
            $table->string('no_of_children')->nullable();
            $table->string('no_of_rooms')->nullable();
            $table->string('hotel_amount')->nullable();

            $table->string('name_of_insurance_applicant')->nullable();
            $table->string('insurance_amount')->nullable();
            $table->string('insurance_remarks')->nullable();

            $table->string('local_sight_sceen_amount')->nullable();
            $table->string('local_sight_sceen_remarks')->nullable();

            $table->string('other_facilities_amount')->nullable();
            $table->string('other_facilities_remarks')->nullable();

            $table->string('car_rental_amount')->nullable();
            $table->string('car_rental_remarks')->nullable();

            $table->string('local_transport_amount')->nullable();
            $table->string('local_transport_remarks')->nullable();
            
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
        Schema::dropIfExists('invoice_infos');
    }
}
