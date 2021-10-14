<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('exam_creates')->onDelete('cascade');
            $table->string('studentId');
            $table->foreign('studentId')->references('PRNo')->on('student_details')->onDelete('cascade');
            
            $table->float('marks');
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
        Schema::dropIfExists('results');
    }
}
