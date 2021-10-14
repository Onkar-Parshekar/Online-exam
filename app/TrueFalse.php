<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrueFalse extends Model
{
    protected $table="true_falses";
    protected $primaryKey="id";
    protected $fillable=['exam_id','question','answer','status','question_type','marks'];
}
