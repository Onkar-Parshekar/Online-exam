<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exam_question_master extends Model
{
    protected $table="mcq_questions";
    protected $primaryKey="id";
    protected $fillable=['exam_id','question','answer','options','status','question_type','marks'];
}
