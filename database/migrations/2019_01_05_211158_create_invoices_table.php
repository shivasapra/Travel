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
            $table->increments('id');
            $table->integer('client_id');
            $table->string('receiver_name');
            $table->string('billing_address');
            $table->Date('invoice_date');
            $table->string('invoice_no');
            $table->string('total');
            $table->string('currency')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discounted_total')->nullable();
            $table->boolean('credit')->default(0);
            $table->string('credit_amount')->nullable();
            $table->boolean('debit')->default(0);
            $table->string('debit_amount')->nullable();
            $table->boolean('cash')->default(0);
            $table->string('cash_amount')->nullable();
            $table->boolean('bank')->default(0);
            $table->string('bank_amount')->nullable();
            $table->integer('paid')->nullable();
            $table->integer('pending_amount')->nullable();
            $table->boolean('status')->default(0);
            $table->Date('mail_sent');
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
