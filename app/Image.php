<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const TYPE_PERSONAL = 1;
    const TYPE_MOMENT = 0;

    protected $table = 'images';

    protected $fillable = ['user_id', 'type', 'url'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function getPrivateImages($user_id){
        return Image::where('user_id', $user_id)->where('type', Image::TYPE_PERSONAL)->get();
    }
}
