<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamCreatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_creates', function (Blueprint $table) {
            $table->id();
            $table->string('exam_title');
            $table->string('exam_date');
            $table->integer('duration');
            $table->integer('total_marks');
            $table->string('subjectName');
            $table->foreign('subjectName')->references('subject_name')->on('tsubject');
            
            $table->integer('status');
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
        Schema::dropIfExists('exam_creates');
    }
}
