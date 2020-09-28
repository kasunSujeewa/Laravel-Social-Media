<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function Store(Request $request)
    {
        $comment= new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$request->post_id;
        $comment->comment=$request->comment;
        $comment->save();
    }
}
