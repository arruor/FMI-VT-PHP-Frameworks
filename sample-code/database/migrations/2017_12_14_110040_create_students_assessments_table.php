<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->tinyInteger('assessment')->unsigned();
            $table->integer('workload_lectures')->unsigned();
            $table->integer('workload_exercises')->unsigned();

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')->on('subjects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_assessments', function(Blueprint $table){
            $table->dropForeign('students_assessments_student_id_foreign');
            $table->dropForeign('students_assessments_subject_id_foreign');
        });

        Schema::dropIfExists('students_assessments');
    }
}
