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
            $table->string('token')->nullable();
            $table->float('total');
            $table->string('currency')->nullable();
            $table->float('discount')->nullable();
            $table->integer('discounted_total')->nullable();
            $table->boolean('credit')->default(0);
            $table->float('credit_amount')->nullable();
            $table->boolean('debit')->default(0);
            $table->float('debit_amount')->nullable();
            $table->boolean('cash')->default(0);
            $table->float('cash_amount')->nullable();
            $table->boolean('bank')->default(0);
            $table->float('bank_amount')->nullable();
            $table->integer('paid')->nullable();
            $table->float('pending_amount')->nullable();
            $table->float('advance')->default(0);
            $table->boolean('status')->default(0);
            $table->Date('mail_sent');
            $table->float('VAT_percentage')->default(0);
            $table->float('VAT_amount')->default(0);
            $table->boolean('refund')->default(0);
            $table->longText('refund_remarks')->nullable();
            $table->longText('Issues')->nullable();
            $table->date('refund_on')->nullable();
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
