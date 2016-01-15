<?php
/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/15
 * Time: 13:02
 */

namespace App\Api\Transformers;


use App\Moment;
use League\Fractal\TransformerAbstract;

class MomentTransformer extends TransformerAbstract
{
    public function transform(Moment $moment)
    {
        $image = $moment->image;
        $user = $moment->user;

        return [
            'id' => $moment->id,
            'text' => $moment->text,
            'user_id' => $user->id,
            'image' => [
                'id' => $image->id,
                'image_url' => $image->url,
                'user_id' => $user->id,
                'type' => $image->type,
            ],
        ];
    }
}