<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompleteOrDontcomplete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_student_asociados', function (Blueprint $table) {
            $table->enum('complete', ['REALIZADO', 'NO REALIZADO'])->default('NO REALIZADO')->after('examen_id');  
              });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_student_asociados', function (Blueprint $table) {
            $table->dropColumn('complete');
        });
    }
}
