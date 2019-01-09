<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->Date('date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('amount');
            $table->string('description');
            $table->boolean('auto')->default(0);
            $table->string('deduction_date')->nullable();
            $table->Date('start_date')->nullable();
            $table->Date('end_date')->nullable();
            $table->boolean('status')->nullable();
            $table->Date('latest')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
