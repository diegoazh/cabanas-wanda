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
            $table->increments('id');
            $table->integer('rentalId')->unsigned();
            $table->enum('type', ['sugerencia', 'queja', 'reclamo'])->default('sugerencia');
            $table->string('title', 30);
            $table->string('description');
            $table->enum('state', ['abierto', 'en proceso', 'cerrado'])->default('abierto');
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rentalId')->references('id')->on('rentals');
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
