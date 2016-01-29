<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    const THIRD_TRUE = 1;
    const THIRD_FALSE = 0;

    const THIRD_NEW_USER = "New user[third]";
    const LOCAL_NEW_USER = "New user";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'is_third', 'gender', 'birthday', 'uid'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function isThird()
    {
        return ($this->is_third == User::THIRD_TRUE);
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function moments()
    {
        return $this->hasMany('App\Moment');
    }

    public function comments(){
        $this->hasMany('App\Comment');
    }

    public function likes(){
        $this->hasMany('App\Like');
    }

    public static function isAccountRegistered($email)
    {
        return (User::where('email', $email)->first() != null);
    }

    public static function isThirdAccountRegisted($uid){
        return (User::where('uid', $uid)->first() != null);
    }

    public static function isAccountValid($email, $password)
    {
        $user = User::where('email', $email)->first();
        if ($user != null) {
            return Hash::check($password, $user->password);
        }
        return false;
    }

    public static function isThirdAccountValid($uid)
    {
        return User::isThirdAccountRegisted($uid);
    }

    public static function getThirdUserByUid($uid){
        return User::where('uid', $uid)->first();
    }

    public static function getLocalUserByEmail($email){
        return User::where('email', $email)->first();
    }

}
