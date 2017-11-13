<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rental_id')->unsigned();
            $table->enum('state', ['pendiente', 'seniado', 'pagado', 'cancelado'])->default('pendiente');
            $table->double('senia', '15', '2')->nullable();
            $table->dateTime('senia_date')->nullable();
            $table->bigInteger('closed_for')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rental_id')->references('id')->on('rentals');
            $table->foreign('closed_for')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
