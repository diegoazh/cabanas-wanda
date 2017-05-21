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
            $table->string('images_header')->nullable();
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
            $table->string('tt_slogan_five')->nullable();
            $table->string('desc_slogan_five')->nullable();
            $table->string('img_slogan_five')->nullable();
            $table->string('tt_slogan_six')->nullable();
            $table->string('desc_slogan_six')->nullable();
            $table->string('img_slogan_six')->nullable();
            $table->boolean('show_slogans_456')->default(false);
            $table->boolean('show_testimonies')->default(false);
            $table->string('link_video')->nullable();
            $table->string('facebook')->nullable();
            $table->boolean('show_facebook')->default(false);
            $table->string('twitter')->nullable();
            $table->boolean('show_twitter')->default(false);
            $table->string('instagram')->nullable();
            $table->boolean('show_instagram')->default(false);
            $table->string('youtube')->nullable();
            $table->boolean('show_youtube')->default(false);
            $table->string('googleplus')->nullable();
            $table->boolean('show_googleplus')->default(false);
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
