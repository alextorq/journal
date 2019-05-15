<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_logs', function (Blueprint $table) {
            $table->increments('lesson_log_id');
            $table->unsignedInteger('schedule_id');
            $table->timestamp('date');
            $table->foreign('schedule_id')->references('schedule_id')->on('schedule');
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
        Schema::dropIfExists('lesson_logs');
    }
}
