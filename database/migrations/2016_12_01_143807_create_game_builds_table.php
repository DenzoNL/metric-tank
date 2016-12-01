<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_builds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games');
            $table->string('name');
            $table->string('description');
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
        Schema::table('game_builds', function ($table) {
            $table->dropForeign(['game_id']);
        });

        Schema::dropIfExists('game_builds');
    }
}
