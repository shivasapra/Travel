<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('unique_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->string('DOB');
            $table->string('marital_status');
            $table->string('disability')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('country');
            $table->string('county');
            $table->string('tax_ref_no');
            // $table->string('passport');
            $table->string('visa');
            $table->string('visa_expired');
            $table->string('permanent_address');
            $table->string('temporary_address');
            $table->string('home_phone');
            $table->string('mobile_phone');
            $table->string('email');
            $table->string('qualification');
            $table->string('experience');
            $table->string('exp_in_dept');
            $table->string('hired_for_dep');
            $table->string('hiring_date');
            $table->string('currency');
            $table->integer('rate');
            $table->string('per');
            $table->string('emer_contact_name');
            $table->string('emer_contact_address');
            $table->string('emer_contact_phone');
            $table->string('emer_contact_email');
            $table->string('emer_contact_relation');
            $table->string('sort_code');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('bank_address');
            $table->string('income_tax_no')->nullable();
            $table->string('national_insurance_no');
            $table->boolean('passport')->default(0);
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->string('passport_place')->nullable();
            $table->string('passport_front')->nullable();
            $table->string('passport_back')->nullable();
            $table->string('work_permit')->nullable();
            $table->string('utility_bill')->nullable();
            $table->boolean('mail_sent')->default(0);
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
        Schema::dropIfExists('employees');
    }
}
