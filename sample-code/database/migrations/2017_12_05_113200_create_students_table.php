<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->integer('fnumber')->unsigned();
            $table->string('email')->unique();
            $table->integer('course_id')->unsigned();
            $table->integer('speciality_id')->unsigned();
            $table->enum('education_form', ['Р', 'З'])->default('Р');
            
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('speciality_id')
                ->references('id')->on('specialities')
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
        Schema::table('students', function(Blueprint $table){
            $table->dropForeign('students_course_id_foreign');
            $table->dropForeign('students_speciality_id_foreign');
        });

        Schema::dropIfExists('students');
    }
}
