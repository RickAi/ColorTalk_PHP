<?php
/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/29
 * Time: 21:52
 */

namespace App\Api\Transformers;


use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

//    protected $request_user_id;
//
//    public function __construct($user_id)
//    {
//        $this->request_user_id = $user_id;
//    }

    public function transform(Comment $comment)
    {
        $likes = $comment->likes;
        return [
            'id' => $comment->id,
            'user_id' => $comment->user_id,
            'moment_id' => $comment->moment_id,
            'text' => $comment->text,
            'like_count' => $likes->count(),
//            'is_liked' => $comment->isUserLiked($request_user_id),
        ];
    }
}