<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchFollowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_followings', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('exam_id');
            $table->string('question');
            $table->string('lhs');
            $table->string('rhs');
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
        Schema::dropIfExists('match_followings');
    }
}
