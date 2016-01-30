<?php
/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/15
 * Time: 12:03
 */

namespace App\Repositories;

use App\Image;
use App\Like;
use App\Moment;
use App\MomentLike;

class MomentRepository
{

    // ['user_id', 'image_name', 'text']
    public function createNewMoment($payload)
    {
        \DB::beginTransaction();
        try {
            // create image first
            $image_id = Image::create([
                'user_id' => $payload['user_id'],
                'type' => Image::TYPE_MOMENT,
                'url' => "http://" . env('QINIU_DOAMIN', "7xkmui.com1.z0.glb.clouddn.com") . '/' . $payload['image_name'],
            ])->id;

            $text = isset($payload['text']) ? $payload['text'] : "";
            // then create moment
            $moment = Moment::create([
                'user_id' => $payload['user_id'],
                'image_id' => $image_id,
                'text' => $text,
            ]);
            \DB::commit();
            // return the content
            return array('result' => true, 'content' => $moment);
        } catch (\Exception $e) {
            \DB::rollBack();
            return array('result' => false, 'message' => $e->getMessage());
        }
    }

    // ['user_id']
    public function likeMoment($payload, Moment $moment)
    {
        \DB::beginTransaction();
        try {
            $like = MomentLike::create([
                'moment_id' => $moment->id,
                'user_id' => $payload['user_id'],
            ]);
            \DB::commit();
            return array('result' => true, 'content' => $like);
        } catch (\Exception $e) {
            \DB::rollBack();
            return array('result' => false, 'message' => $e->getMessage());
        }
    }

}