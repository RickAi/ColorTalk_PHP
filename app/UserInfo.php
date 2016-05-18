<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_infos';

    protected $fillable = ['nickname', 'icon_url', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
