<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankingAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banking_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank');
            $table->string('branch_office');
            $table->string('account_holder');
            $table->bigInteger('cuit');
            $table->enum('type', ['caja_de_ahorro', 'cuenta_corriente'])->default('cuenta_corriente');
            $table->bigInteger('nro_cta');
            $table->decimal('cbu', 65, 0);
            $table->string('alias')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banking_account');
    }
}
