<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('unique_id');
            $table->Time('login');
            $table->Time('logout')->nullable();
            $table->Date('date');
            $table->string('hourly');
            $table->string('hours')->nullable();
            $table->string('wage')->nullable();
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
        Schema::dropIfExists('wages');
    }
}
