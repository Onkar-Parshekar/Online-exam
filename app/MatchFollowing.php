<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchFollowing extends Model
{
    protected $table="match_followings";
    protected $primaryKey="id";
    protected $fillable=['exam_id','question','lhs','rhs','status','question_type','marks'];
}
