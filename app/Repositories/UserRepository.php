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
    // ['name', 'email', 'password', 'is_third', 'gender', 'birthday'];
    public function createNewAccount($payload){
        \DB::beginTransaction();
        try{
            $user = User::create($payload);
            if(!$user->isThird()){
                $user->password = bcrypt('secret');
            }

            $user->save();
            \DB::commit();
            return array('result' => true, 'content' => $user);
        } catch(\Exception $e){
            \DB::rollBack();
            return array('result' => false, 'message' => 'db error happen when create new user!');
        }
    }

}