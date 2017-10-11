<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pedido_id')->unsigned();
            $table->bigInteger('comida_id')->unsigned();
            $table->dateTime('fecha_entrega');
            $table->integer('cantidad');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('comida_id')->references('id')->on('comidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pedidos');
    }
}
