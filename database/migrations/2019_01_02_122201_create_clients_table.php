<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->string('status')->nullable();
            $table->integer('user_id');
            $table->boolean('permanent')->default(0);
            $table->string('credit_limit')->nullable();
            $table->string('currency')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('county');
            $table->string('country');
            $table->string('phone');
            $table->string('DOB');
            $table->string('email');
            $table->string('token', 16)->unique()->nullable();
            $table->boolean('confirmation')->default(0);
            $table->boolean('mail_sent')->default(0);
            $table->boolean('passport')->default(0);
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->string('passport_place')->nullable();
            $table->string('passport_front')->nullable();
            $table->string('passport_back')->nullable();
            $table->string('letter')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
