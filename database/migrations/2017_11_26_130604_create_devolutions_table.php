<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rental_id')->unsigned();
            $table->boolean('from_admin')->default(false);
            $table->mediumText('description')->nullable();
            $table->enum('state', ['en proceso', 'realizada', 'atrasada'])->default('en proceso');
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
        Schema::dropIfExists('devolutions');
    }
}
