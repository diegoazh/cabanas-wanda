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
            $table->string('codeReservation', 40);
            $table->integer('cottage_id')->unsigned();
            $table->date('from');
            $table->date('to');
            $table->string('description', 200)->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('passenger_id')->unsigned()->nullable();
            $table->integer('promotion_id')->unsigned()->nullable();
            $table->double('cottage_price', 8, 2);
            $table->integer('total_days');
            $table->datetime('dateReservationPayment');
            $table->double('deductions', 8, 2)->nullable();
            $table->string('deductionsDescription')->nullable();
            $table->double('finalPayment', 8, 2)->nullable();
            $table->datetime('dateFinalPayment')->nullable();
            $table->enum('state', ['pendiente', 'confirmada', 'concretada', 'finalizada', 'cancelada'])->default('pendiente');
            $table->boolean('wasRated')->default(false);
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
