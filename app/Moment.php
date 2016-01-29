<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    protected $table = 'moments';

    protected $fillable = ['text', 'user_id', 'image_id'];

    public function image(){
        return $this->belongsTo('App\Image');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Moment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function isUserLiked($user_id){
        $likes = $this->likes;
        foreach ($likes as $like) {
            if($like->user_id == $user_id){
                return true;
            }
        }
        return false;
    }
}
