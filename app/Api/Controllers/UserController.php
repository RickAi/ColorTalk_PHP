<?php

namespace App\Api\Controllers;

use App\Api\Transformers\UserTransformer;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends BaseController
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function getUsers(){
        $users = User::all();
        return $this->collection($users, new UserTransformer);
    }

    // create a account
    public function createUser(Request $request){
        $payload = $request->all();
        $result_array = $this->userRepo->createNewAccount($payload);

        if($result_array['result']){
            $user = $result_array['content'];
            return response()->json($user);
        } else{
            return $this->response->error($result_array['message'], 422);
        }
    }

    // login into the system
    // 点击登录按钮才使用这个接口
    public function login(Request $request){
        $payload = $request->all();
        $result_array = $this->userRepo->loginIntoSystem($payload);

        if($result_array['result']){
            $user = $result_array['content'];
            return response()->json($user);
        } else{
            return $this->response->error($result_array['message'], 422);
        }
    }
}
