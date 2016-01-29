<?php

namespace App\Api\Controllers;

use App\Api\Transformers\CommentTransformer;
use App\Comment;
use App\Http\Requests\Request;
use App\Moment;

class CommentController extends BaseController
{

    public function index(Moment $moment){
        $comments = Comment::where('moment_id', $moment->id)->orderBy('created_at', 'asc')->paginate(20);
        return $this->paginator($comments, new CommentTransformer);
    }

    public function store(Request $request){

    }

    public function likeComment(){

    }

}
