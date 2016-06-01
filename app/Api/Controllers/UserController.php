<?php

namespace App\Api\Controllers;

use App\Api\Transformers\UserTransformer;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Snowfire\Beautymail\Beautymail;

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

    public function forget(Request $request){
        $payload = $request->all();
        $email = $payload['email'];

        try{
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('emails.welcome', ['email' => $email], function($message) use ($email)
            {
                $message
                    ->from('ayb854@163.com')
                    ->to($email, 'ColorTalk User')
                    ->subject('Reset the password.');
            });
            return response()->json(['result' => true]);
        } catch(\Exception $e){
            return response()->json(['result' => false]);
        }

    }

    public function register(Request $request){
        $payload = $request->all();
        $result_array = $this->userRepo->registerUser($payload);

        if($result_array['result']){
            $user = $result_array['content'];
            return response()->json($user);
        } else{
            return $this->response->error($result_array['message'], 422);
        }
    }

    public function userInfo(User $user){
        $userInfo = $user->userInfo;
        if($userInfo != null){
            return response()->json($userInfo);
        } else{
            return $this->response->error(['result', 'failed'], 422);
        }
    }
}
