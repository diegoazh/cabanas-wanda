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
            $table->date('date_of_birth')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->bigInteger('dni')->unique();
            $table->string('passport', 20)->nullable();
            $table->string('email', 50)->unique();
            $table->bigInteger('celphone')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('destination', 30)->nullable();
            $table->string('password');
            $table->enum('type', ['frecuente', 'empleado', 'administrador', 'sysadmin'])->default('frecuente');
            $table->string('image_profile')->nullable();
            $table->string('slug')->nullable();
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
