<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subjectName');
            $table->string('studentNo');
            $table->integer('rollNo');
            $table->string('course');
            $table->foreign('subjectName')->references('subject_name')->on('tsubject')->onDelete('cascade');
            $table->foreign('studentNo')->references('PRNo')->on('student_details');
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
        Schema::dropIfExists('student_subjects');
    }
}
