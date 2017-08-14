<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $table = 'user_courses';
    protected $fillable = ['course_id','user_id'];


}
