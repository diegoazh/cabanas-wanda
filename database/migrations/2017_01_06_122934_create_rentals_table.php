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
            $table->integer('cottage_id')->unsigned();
            $table->date('from');
            $table->date('to');
            $table->boolean('own');
            $table->string('description', 200)->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('passenger_id')->unsigned()->nullable();
            $table->integer('promotion_id')->unsigned()->nullable();
            $table->double('total_amount', 5, 2);
            $table->double('reservation_payment', 5, 2);
            $table->datetime('date_reservation_payment');
            $table->double('deductions', 5, 2)->nullable();
            $table->string('deductions_description')->nullable();
            $table->double('final_payment', 5, 2)->nullable();
            $table->datetime('date_final_payment')->nullable();
            $table->enum('state', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->enum('cottage_state', ['reservada', 'ocupada'])->default('reservada');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cottage_id')->references('id')->on('cottages');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('passenger_id')->references('id')->on('passengers');
            $table->foreign('promotion_id')->references('id')->on('promotions');
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
