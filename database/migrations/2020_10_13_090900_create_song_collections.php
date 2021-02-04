<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_collections', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('song_name');
            $table->string('song_description');

            $table->string('soundcloud_url')->nullable();
            $table->string('mixcloud_url')->nullable();
            $table->string('website_url')->nullable();

            $table->dateTime('published_at');

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
        Schema::dropIfExists('song_collections');
    }
}
