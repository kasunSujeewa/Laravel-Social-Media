<?php

namespace App\Http\Controllers;
use App\Post;
use App\Like;
use App\Comment;
use App\User;
use App\FriendRequest;
use App\Friends;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        $like = Like::all();
        $user = User::where('id','!=', Auth::user()->id)->get();
    
   
        $friend_req=FriendRequest::where('friend_id',Auth::user()->id)->get();
        $friends=Friends::where('user_id',Auth::user()->id)->orWhere('friend_id',Auth::user()->id)->get();
      
        return view('home')->with('posts',$posts)->with('like',$like)->with('user',$user)->with('friend_rq',$friend_req)->with('friends',$friends);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts= new Post;
        $posts->user_id=Auth::user()->id;
        $posts->postName=$request->postName;
        $posts->description=$request->description;
        $posts->save();
        // $posts->all();
        // return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        $like=$post->likes->all();
        $comments=$post->comments->all();
        return view('Post.Post')->with('post',$post)->with('likes',$like)->with('comments',$comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $post=POST::findOrFail($id);
        $post->update($request->all());
        $post->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=POST::findOrFail($id);
        $post->likes()->forceDelete();
        $post->comments()->forceDelete();
        $post->delete();

    }
}
