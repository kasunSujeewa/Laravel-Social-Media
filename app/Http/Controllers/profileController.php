<?php

namespace App\Http\Controllers;
use App\Profile;
use App\User;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function show($slug)
    {
        $user=User::where('slug',$slug)->first();
        $profile=Profile::Where('user_id',$user->id)->first();
        $posts=Post::where('user_id',$profile->user->id)->latest()->paginate(5);


       

        return view('Profile.Profile')->with('user',$user)->with('profile',$profile)->with('posts',$posts);
    }
    public function Update(Request $request,$id)
    {
        $profile=Profile::findOrFail($id);
        $profile->update($request->all());
        $profile->save();
    }
}
