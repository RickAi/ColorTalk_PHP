<?php

namespace App\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function requestCheck($request, $strict){
        $v = Validator::make($request->all(), $strict);

        if ($v->fails()) {
            $messages = $v->messages();
            return array('result' => false, 'message' => $messages->first());
        }
        return array('result' => true);
    }
}