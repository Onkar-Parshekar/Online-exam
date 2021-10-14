<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class result extends Model
{
    protected $table="results";
    protected $primarykey="id";
    protected $fillable=['exam_id','studentId','marks'];
}
