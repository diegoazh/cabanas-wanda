<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tt_presentation');
            $table->string('msg_presentation');
            $table->string('txt_btn_presentation');
            $table->string('lnk_btn_presentation');
            $table->string('tt_slogan_one');
            $table->string('desc_slogan_one');
            $table->string('img_slogan_one');
            $table->string('tt_slogan_two');
            $table->string('desc_slogan_two');
            $table->string('img_slogan_two');
            $table->string('tt_slogan_three');
            $table->string('desc_slogan_three');
            $table->string('img_slogan_three');
            $table->string('tt_slogan_four')->nullable();
            $table->string('desc_slogan_four')->nullable();
            $table->string('img_slogan_four')->nullable();
            $table->boolean('show_slogan_four')->default(false);
            $table->string('tt_slogan_five')->nullable();
            $table->string('desc_slogan_five')->nullable();
            $table->string('img_slogan_five')->nullable();
            $table->boolean('show_slogan_five')->default(false);
            $table->string('tt_slogan_six')->nullable();
            $table->string('desc_slogan_six')->nullable();
            $table->string('img_slogan_six')->nullable();
            $table->boolean('show_slogan_six')->default(false);
            $table->boolean('show_testimonies')->default(false);
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
        Schema::dropIfExists('frontend_contents');
    }
}
