<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rental_id')->unsigned();
            $table->enum('type', ['sugerencia', 'queja', 'reclamo'])->default('sugerencia');
            $table->string('title', 30);
            $table->string('description');
            $table->enum('state', ['abierto', 'en proceso', 'cerrado'])->default('abierto');
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
