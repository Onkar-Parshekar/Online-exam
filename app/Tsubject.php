<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tsubject extends Model
{
    protected $table="Tsubject";
    protected $primaryKey="subject_name";
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['subject_code','subject_name','course_name','teacher_id','semester','enrollment_key','status'];
}
