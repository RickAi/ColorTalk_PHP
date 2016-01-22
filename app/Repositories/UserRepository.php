<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/13
 * Time: 11:55
 */
class UserRepository
{

    // create a new user
    // ['email', 'password'];
    public function createNewAccount($payload)
    {
        \DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $payload->email,
                'email' => $payload->email,
                'password' => bcrypt($payload['password']),
                'is_third' => User::THIRD_FALSE,
            ]);
            \DB::commit();
            return array('result' => true, 'content' => $user);
        } catch (\Exception $e) {
            \DB::rollBack();
            return array('result' => false, 'message' => 'db error happen when create new user!');
        }
    }

    public function loginIntoSystem($payload){
        $isThird = $payload['is_third'];
        if($isThird == User::THIRD_TRUE){
            $uid = $payload['uid'];
            $user = $this->thirdAccountRegister($uid);
            return array('result' => true, 'content' => $user);
        } else{
            $email = $payload['email'];
            $password = $payload['password'];
            return $this->localAccountRegister($email, $password);
        }
    }

    private function localAccountRegister($email, $password){
        if(User::isAccountRegistered($email)){
            return array('result' => false, 'message' => 'The email has been registered!');
        }
        if(!User::isAccountValid($email, $password)){
            return array('result' => false, 'message' => 'The email and password do not match!');
        }
        $user = User::getLocalUserByEmail($email);
        return array('result' => true, 'content' => $user);
    }

    private function thirdAccountRegister($uid){
        if(!User::isThirdAccountRegisted($uid)){
            $user = User::create([
                'name' => User::THIRD_NEW_USER,
                'uid' => $uid,
                'is_third' => User::THIRD_TRUE,
            ]);
            return $user;
        } else{
            $user = User::getThirdUserByUid($uid);
            return $user;
        }
    }

}