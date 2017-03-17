<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_reservation', 40);
            $table->integer('cottageId')->unsigned();
            $table->date('from');
            $table->date('to');
            $table->boolean('own');
            $table->string('description', 200)->nullable();
            $table->integer('userId')->unsigned()->nullable();
            $table->integer('passengerId')->unsigned()->nullable();
            $table->integer('promotionId')->unsigned()->nullable();
            $table->double('totalAmount', 5, 2);
            $table->double('reservationPayment', 5, 2);
            $table->datetime('dateReservationPayment');
            $table->double('deductions', 5, 2)->nullable();
            $table->string('deductionsDescription')->nullable();
            $table->double('finalPayment', 5, 2)->nullable();
            $table->datetime('dateFinalPayment')->nullable();
            $table->enum('state', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->enum('cottageState', ['reservada', 'ocupada'])->default('reservada');
            $table->boolean('was_rated')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cottageId')->references('id')->on('cottages');
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('passengerId')->references('id')->on('passengers');
            $table->foreign('promotionId')->references('id')->on('promotions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
