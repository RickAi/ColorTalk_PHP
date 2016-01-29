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
    public function transform(Comment $comment)
    {
        $likes = $comment->likes;
        return [
            'id' => $comment->id,
            'user_id' => $comment->user_id,
            'moment_id' => $comment->moment_id,
            'text' => $comment->text,
            
        ];
    }
}