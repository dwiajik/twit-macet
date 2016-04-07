<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day', 9);
            $table->string('hour', 2);
            $table->string('classifier', 13);
            $table->bigInteger('days_count');
            $table->bigInteger('tweets_count');

            $table->index('day');
            $table->index('hour');
            $table->index('classifier');

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
        Schema::drop('tweet_summaries');
    }
}
