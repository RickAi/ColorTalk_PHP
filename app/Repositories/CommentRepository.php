<?php
/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/29
 * Time: 22:23
 */

namespace App\Repositories;


use App\Comment;
use App\CommentLike;
use App\Like;
use App\Moment;

class CommentRepository
{

    // ['user_id', 'text']
    public function createComment($payload, Moment $moment){
        \DB::beginTransaction();
        try {
            $comment = Comment::create([
                'user_id' => $payload['user_id'],
                'moment_id' => $moment->id,
                'text' => $payload['text'],
            ]);
            \DB::commit();
            return array('result' => true, 'content' => $comment);
        } catch (\Exception $e) {
            \DB::rollBack();
            return array('result' => false, 'message' => $e->getMessage());
        }
    }

    // ['user_id']
    public function likeComment($payload, Comment $comment){
        \DB::beginTransaction();
        try {
            $like = CommentLike::create([
                'comment_id' => $comment->id,
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