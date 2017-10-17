<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha_pedido');
            $table->bigInteger('rental_id')->unsigned();
            $table->enum('estado', ['pendiente', 'preparandose', 'entregado'])->default('pendiente');
            $table->boolean('pagado')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rental_id')->references('id')->on('rentals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
