<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneWord extends Model
{
    protected $table="one_words";
    protected $primaryKey="id";
    protected $fillable=['exam_id','question','answer','status','question_type','marks'];
}
