<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use itbdw\QiniuStorage\QiniuStorage;

class QiniuController extends BaseController
{
    public function getToken(Request $request){
        $check_result = $this->requestCheck($request, ['image_name' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $disk = QiniuStorage::disk('qiniu');
        return $disk->uploadToken($request->get('image_name'));
    }
}
