<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentSubjects extends Model
{
    protected $table="student_subjects";
    protected $primaryKey="id";
    protected $fillable=['subjectName','subjectNo','rollNo','course'];
}
