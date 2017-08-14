<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $fillable = ['course_id', 'name', 'description'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
