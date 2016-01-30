<?php

namespace App\Api\Controllers;

use App\Api\Transformers\CommentTransformer;
use App\Comment;
use Illuminate\Http\Request;
use App\Moment;
use App\Repositories\CommentRepository;

class CommentController extends BaseController
{

    protected $commentRepo;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepo = $commentRepository;
    }

    // get all the comments, with the like's status of the user
    public function getComments(Request $request, Moment $moment)
    {
        $check_result = $this->requestCheck($request,
            ['user_id' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $comments = Comment::where('moment_id', $moment->id)->orderBy('created_at', 'asc')->paginate(20);
        return $this->paginator($comments, new CommentTransformer($payload['user_id']));
    }

    // create a comment
    public function createComment(Request $request, Moment $moment)
    {
        $check_result = $this->requestCheck($request,
            ['user_id' => 'required', 'text' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $result_array = $this->commentRepo->createComment($payload, $moment);
        if ($result_array['result']) {
            $moment = $result_array['content'];
            return response()->json($moment);
        } else {
            return $this->response->error($result_array['message'], 422);
        }
    }

    // increase the comment's like number
    public function likeComment(Request $request, Moment $moment, Comment $comment)
    {
        $check_result = $this->requestCheck($request,
            ['user_id' => 'required']);
        if (!$check_result['result']) {
            return $this->response->error($check_result['message'], 422);
        }

        $payload = $request->all();
        $result_array = $this->commentRepo->likeComment($payload, $comment);
        if ($result_array['result']) {
            $comment = $result_array['content'];
            return response()->json($comment);
        } else {
            return $this->response->error($result_array['message'], 422);
        }
    }

}
