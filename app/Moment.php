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
        $this->hasMany('App\Moment');
    }

    public function likes(){
        $this->hasMany('App\Like');
    }
}
