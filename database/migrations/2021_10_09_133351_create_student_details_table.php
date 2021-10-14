<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->string('PRNo');
            $table->string('Fname');
            $table->string('Lname');
            $table->string('email');
            $table->string('password');
            $table->string('Cpassword');
            $table->integer('rollNo');
            $table->string('course');
            $table->timestamps();
            $table->primary('PRNo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
}
