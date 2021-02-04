<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamerCommunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamer_communities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('streamer_name');
            $table->text('description');

            $table->string('twitch_url');

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
        Schema::dropIfExists('streamer_communities');
    }
}
