<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStateCottagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cottages', function (Blueprint $table) {
            $table->enum('state', ['libre', 'reservada', 'ocupada', 'mantenimiento', 'inhabilitada'])->default('libre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cottages', function (Blueprint $table) {
            $table->dropColumn('state');
        });
    }
}
