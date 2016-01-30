<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MomentLike extends Model
{
    protected $table = 'moment_likes';

    protected $fillable = ['moment_id','user_id'];

    public function moment(){
        return $this->belongsTo('App\Moment');
    }

}
