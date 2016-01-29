<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    const TYPE_MOMENT = 1;
    const TYPE_COMMENT = 2;

    protected $table = 'likes';

    protected $fillable = ['count', 'moment_id', 'comment_id', 'type'];

    public function moment(){
        return $this->belongsTo('App\Moment');
    }

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

}
