<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metric_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('metric_category_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('metric_category_id')->references('id')->on('metric_categories');
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
        Schema::table('metric_names', function ($table) {
            $table->dropForeign(['metric_category_id']);
        });

        Schema::dropIfExists('metric_names');
    }
}
