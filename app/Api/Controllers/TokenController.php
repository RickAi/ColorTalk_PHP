<?php

namespace App\Api\Controllers;

use App\Services\Facades\RongCloud;
use Illuminate\Http\Request;
use itbdw\QiniuStorage\QiniuStorage;

class TokenController extends BaseController
{
    public function qiniuToken(Request $request){
        $check_result = $this->requestCheck($request, ['image_name' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $disk = QiniuStorage::disk('qiniu');
        return $disk->uploadToken($request->get('image_name'));
    }

    public function rongToken(Request $request){
        $check_result = $this->requestCheck($request, [
            'user_id' => 'required',
            'name' => 'required',
            'url' => 'required',
        ]);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $rong_result = RongCloud::getToken($payload['user_id'], $payload['name'], $payload['url']);
        $rong_result = json_decode($rong_result, true);
        if($rong_result['code'] == 200){
            return response()->json(['token' => $rong_result['token']]);
        } else{
            return $this->response->error("get token failed!", 422);
        }
    }

}
