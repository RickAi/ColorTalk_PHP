<?php
/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/15
 * Time: 13:03
 */

namespace App\Api\Transformers;


use App\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{

    public function transform(Image $image)
    {
        return [
            'id' => $image->id,
            'image_url' => $image->url,
            'user_id' => $image->user->id,
            'type' => $image->type,
        ];
    }

}