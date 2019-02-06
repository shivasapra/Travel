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
            $table->string('unique_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('DOB')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('disability')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('country')->nullable();
            $table->string('county')->nullable();
            $table->string('tax_ref_no')->nullable();
            // $table->string('passport');
            $table->string('visa')->nullable();
            $table->string('visa_expired')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('temporary_address')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('exp_in_dept')->nullable();
            $table->string('hired_for_dep')->nullable();
            $table->string('hiring_date')->nullable();
            $table->string('currency')->nullable();
            $table->integer('rate')->nullable();
            $table->string('per')->nullable();
            $table->string('emer_contact_name')->nullable();
            $table->string('emer_contact_address')->nullable();
            $table->string('emer_contact_phone')->nullable();
            $table->string('emer_contact_email')->nullable();
            $table->string('emer_contact_relation')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
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
