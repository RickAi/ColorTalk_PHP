<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['user_id', 'moment_id', 'text'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function moment(){
        return $this->belongsTo('App\Moment');
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
