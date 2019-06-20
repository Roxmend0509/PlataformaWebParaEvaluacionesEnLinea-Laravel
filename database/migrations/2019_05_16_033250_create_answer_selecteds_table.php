<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerSelectedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_selecteds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('preguntas');
            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('respuestas');
            $table->integer('exam_student_id')->unsigned();
            $table->foreign('exam_student_id')->references('id')->on('exam_student_asociados');
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
        Schema::dropIfExists('answer_selecteds');
    }
}
