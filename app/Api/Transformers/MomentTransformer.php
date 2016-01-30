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
    protected $request_user_id;

    public function __construct($user_id)
    {
        $this->request_user_id = $user_id;
    }

    public function transform(Moment $moment)
    {
        $image = $moment->image;
        $user = $moment->user;
        $likes = $moment->likes;

        return [
            'id' => $moment->id,
            'text' => $moment->text,
            'created_at' => $moment->created_at->toDateTimeString(),
            'updated_at' => $moment->updated_at->toDateTimeString(),
            'is_liked' => $moment->isUserLiked($this->request_user_id),
            'like_count' => $likes->count(),
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