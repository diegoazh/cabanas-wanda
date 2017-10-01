<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('lastname', 40);
            $table->enum('genre', ['m', 'f', 'o'])->default('m');
            $table->date('dateOfBirth')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->bigInteger('dni')->unique()->nullable();
            $table->string('passport', 20)->unique()->nullable();
            $table->string('email', 50)->unique();
            $table->bigInteger('celphone')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('destination', 150)->nullable();
            $table->string('password');
            $table->enum('type', ['frecuente', 'empleado', 'administrador', 'sysadmin'])->default('frecuente');
            $table->string('imageProfile')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
