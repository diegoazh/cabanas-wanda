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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->enum('genre', ['m', 'f', 'o'])->default('m');
            $table->date('dateOfBirth')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->bigInteger('dni')->unique()->nullable();
            $table->string('passport', 20)->unique()->nullable();
            $table->string('email')->unique();
            $table->bigInteger('celphone')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('destination')->nullable();
            $table->string('password')->nullable();
            $table->enum('type', ['frecuente', 'empleado', 'administrador', 'sysadmin'])->default('frecuente');
            $table->string('imageProfile')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('confirmation_code', 150)->nullable();
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
