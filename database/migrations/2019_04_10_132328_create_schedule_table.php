<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('schedule_id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('lesson_id');
            $table->time('dateFrom');
            $table->time('dateTo');
            $table->string('day');
            $table->index(['user_id']);
            $table->index(['day']);
            $table->index(['group_id']);
            $table->foreign('group_id')->references('group_id')->on('student_groups');
            $table->foreign('lesson_id')->references('lesson_id')->on('lessons');
            $table->foreign('user_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('schedule');
    }
}
