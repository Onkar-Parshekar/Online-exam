<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrueFalsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('true_falses', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('exam_id');
            $table->string('question');
            $table->string('answer');
            $table->integer('status');
            $table->string('question_type');
            $table->float('marks');
            $table->foreign('exam_id')->references('id')->on('exam_creates')->onDelete('cascade');
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
        Schema::dropIfExists('true_falses');
    }
}
