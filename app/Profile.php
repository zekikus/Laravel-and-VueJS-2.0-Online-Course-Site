<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    public $with = ['user'];
    protected $table = 'profiles';
    protected $fillable = ['user_id', 'location', 'about', 'avatar'];

    public function user(){
        return $this->belongsTo(User::class)->select(['id','name','slug']);
    }

    public function courses(){
        return $this->hasMany('App\Course','user_id','user_id')->select(['name','slug','image','description']);
    }

    public function getAvatarAttribute($avatar){
        return asset(Storage::url($avatar));
    }
}
