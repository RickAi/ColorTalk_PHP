<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function getUsers(){
        $users = User::all();
        return $users->toJson();
    }

    // create a account
    public function createUser(Request $request){
        $payload = $request->all();
        $result_array = $this->userRepo->createNewAccount($payload);

        if($result_array['result']){
            return response()->json(['status' => true, 'user' => $result_array['content']]);
        } else{
            return response()->json(['status' => false, 'message' => $result_array['message']]);
        }
    }
}
