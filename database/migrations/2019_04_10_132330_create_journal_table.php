<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal', function (Blueprint $table) {
            $table->increments('journal_id');
            $table->unsignedInteger('lesson_log_id');
            $table->unsignedInteger('user_id');
            $table->boolean('is_visited')->default(0);
            $table->json('additional')->nullable();
            $table->foreign('lesson_log_id')->references('lesson_log_id')->on('lesson_logs');
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
        Schema::dropIfExists('journal');
    }
}
