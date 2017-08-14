<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name', 'slug', 'user_id', 'image', 'description'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function users(){
        return $this->belongsToMany('App\User', 'user_courses', 'course_id', 'user_id')
            ->select(['users.id','users.name','users.email']);
    }

    public function getImageAttribute($image){
        return asset(Storage::url($image));
    }

}
