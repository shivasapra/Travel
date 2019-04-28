<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('unique_id');
            $table->string('client_name');
            $table->string('mobile');
            $table->string('visa_applicant_name');
            $table->string('DOB');
            $table->string('passport_origin');
            $table->string('passport_no');
            $table->string('visa_country');
            $table->string('visa_type');
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
        Schema::dropIfExists('client_docs');
    }
}
