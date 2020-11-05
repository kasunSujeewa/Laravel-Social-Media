<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use App\Notifications\CommentNotification;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function Store(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();
        if ($comment->user_id !== $comment->post->user_id) {

            $comment->post->user->notify(new CommentNotification($comment));
        } else {
            $users = collect($comment->post->comments->pluck('user_id'));
            $user2 = $users->unique();
            $post = $comment->post->id;






            foreach ($user2 as $user) {

                $user1 = User::find($user);
                $user1->notify(new CommentNotification($comment));
            }
        }
    }
    public function delcom(Request $req)
    {
        $comment = Comment::where('id', $req->comment_id);
        $comment->delete();
    }
}
