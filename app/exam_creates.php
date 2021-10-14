<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exam_creates extends Model
{
    protected $table="exam_creates";
    protected $primaryKey="id";
    protected $fillable=['exam_title','exam_date','duration','total_marks','subjectName','status'];
}
