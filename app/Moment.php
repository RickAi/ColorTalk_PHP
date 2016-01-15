<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    protected $table = 'moments';

    protected $fillable = ['text', 'user_id', 'image_id'];

    public function image(){
        return $this->hasOne('App\Image');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
