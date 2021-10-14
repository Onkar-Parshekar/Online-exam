<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentDetails extends Model
{
    protected $table = "student_details";
    protected $primaryKey="PRNo";
    public $incrementing = false;
    protected $fillable=['PRNo','Fname','Lname','email','password','Cpassword','rollNo','course'];
}
