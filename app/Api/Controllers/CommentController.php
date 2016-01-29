<?php

namespace App\Api\Controllers;

use App\Api\Transformers\CommentTransformer;
use App\Comment;
use App\Http\Requests\Request;
use App\Moment;
use App\Repositories\CommentRepository;

class CommentController extends BaseController
{

    protected $commentRepo;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepo = $commentRepository;
    }

    public function getComments(Moment $moment)
    {
        $comments = Comment::where('moment_id', $moment->id)->orderBy('created_at', 'asc')->paginate(20);
        return $this->paginator($comments, new CommentTransformer);
    }

    public function createComment(Request $request, Moment $moment)
    {

    }

    public function likeComment(Request $request, Moment $moment, Comment $comment)
    {

    }

}
