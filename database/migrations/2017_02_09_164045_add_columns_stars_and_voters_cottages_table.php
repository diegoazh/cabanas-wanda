<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsStarsAndVotersCottagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cottages', function (Blueprint $table) {
            $table->integer('stars');
            $table->integer('voters');
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
            $table->dropColumn('stars');
            $table->dropColumn('voters');
        });
    }
}
