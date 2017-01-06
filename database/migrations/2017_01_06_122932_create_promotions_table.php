<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->double('amount', 5, 2)->nullable();
            $table->integer('percentage')->nullable();
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('state', ['pausada', 'vigente', 'finalizada', 'oculta'])->default('oculta');
            $table->string('description_state');
            $table->string('terms_and_conditions');
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
        Schema::dropIfExists('promotions');
    }
}
