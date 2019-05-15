<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_books', function (Blueprint $table) {
            $table->increments('record_book_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('lesson_id');
            $table->unsignedInteger('mark');
            $table->unique(['lesson_id', 'user_id']);
            $table->timestamp('receipt_date');
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
        Schema::dropIfExists('record_book');
    }
}
