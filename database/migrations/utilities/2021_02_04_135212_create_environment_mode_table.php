<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * environment_mode
         * Environment mode is a utility related table 
         * that used for giving state information of this application.
         * 
         */
        Schema::create('environment_mode', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('state_name', 20)
                ->unique()
                ->comment('Environment state. You can call this whatever you like. This column is unique.');


            $table->string('state_description', 120)
                ->default('Environment state.')
                ->comment('Environment state description. e.g: When this state triggered, the program down.');

            $table->tinyInteger('status')
                ->comment('Environment state status. 1 : Current State | 0: Not Current State');

            $table->datetime('last_trigger')
                ->nullable()
                ->comment('When the last time that the project get on this state.');

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
        Schema::dropIfExists('environment_mode');
    }
}
