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
            $table->Date('infant_dob')->nullable();
            $table->string('name_of_visa_applicant')->nullable();
            $table->string('passport_origin')->nullable();
            $table->string('visa_country')->nullable();
            $table->string('visa_type')->nullable();
            $table->string('visa_charges')->nullable();

            $table->integer('quantity')->nullable();
            $table->string('currency')->nullable();
            $table->integer('price')->nullable();
            $table->integer('amount')->nullable();
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
