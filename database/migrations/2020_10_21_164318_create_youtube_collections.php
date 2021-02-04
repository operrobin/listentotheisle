<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_collections', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');

            $table->string('youtube_url');
            $table->string('title');
            $table->text('short_description');

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
        Schema::dropIfExists('youtube_collections');
    }
}
