<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsubject', function (Blueprint $table) {
            $table->string('subject_code');
            $table->string('subject_name');
            $table->string('course_name');
            $table->integer('semester');
            $table->string('enrollment_key');
            $table->string('teacher_id');
            $table->integer('status');
            $table->foreign('teacher_id')->references('uid')->on('users');
            $table->primary('subject_name');

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
        Schema::dropIfExists('tsubjects');
    }
}
