<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->integer('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->integer('game_build_id')->unsigned();
            $table->foreign('game_build_id')->references('id')->on('game_builds');
            $table->ipAddress('ip_address')->nullable();
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
        Schema::table('sessions', function ($table) {
            $table->dropForeign(['device_id']);
            $table->dropForeign(['platform_id']);
            $table->dropForeign(['game_build_id']);
        });

        Schema::dropIfExists('sessions');
    }
}
