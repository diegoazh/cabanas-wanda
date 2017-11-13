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
            $table->integer('number')->unique();
            $table->string('name', 100);
            $table->enum('type', ['matrimonial', 'simple']);
            $table->enum('state', ['enabled', 'disabled'])->default('disabled');
            $table->integer('accommodation');
            $table->text('description');
            $table->string('images');
            $table->double('price', 5, 2);
            $table->integer('stars')->nullable();
            $table->integer('voters')->nullable();
            $table->string('slug')->nullable();
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
