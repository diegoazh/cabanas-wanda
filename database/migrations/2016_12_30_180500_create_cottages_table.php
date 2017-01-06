<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCottagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cottages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->string('letter', 1);
            $table->enum('type', ['matrimonial', 'simple']);
            $table->integer('accommodation');
            $table->string('description');
            $table->string('images');
            $table->double('price', 5, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cottages');
    }
}
