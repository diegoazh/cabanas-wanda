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
            $table->bigIncrements('id');
            $table->string('name', 100)->unique();
            $table->double('amount', 5, 2)->nullable();
            $table->integer('percentage')->nullable();
            $table->string('description');
            $table->date('startDate');
            $table->date('endDate');
            $table->enum('state', ['pausada', 'vigente', 'finalizada', 'oculta'])->default('oculta');
            $table->string('descriptionState');
            $table->string('termsAndConditions');
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
        Schema::dropIfExists('promotions');
    }
}
