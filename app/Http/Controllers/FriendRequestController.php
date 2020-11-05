<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Friends;
use App\FriendRequest;

class FriendRequestController extends Controller
{
    public function Store(Request $req)
    {
        $request = new FriendRequest;
        $request->user_id = Auth::user()->id;
        $request->friend_id = $req->friend_id;

        $request->save();
    }
    public function destroy(Request $req)
    {
        $request = Auth::user()->friendRequestsSend->where('friend_id', $req->friend_id)->first();
        $request->delete();
    }
    public function confirm(Request $req)
    {
        $request = FriendRequest::where('user_id', $req->friend_id)->where('friend_id', Auth::user()->id)->first();

        $request->status = true;
        $request->save();
        Friends::create([
            'user_id' => $req->friend_id,
            'friend_id' => Auth::user()->id
        ]);
        Friends::create([
            'friend_id' => $req->friend_id,
            'user_id' => Auth::user()->id
        ]);
    }
    public function remove(Request $req)
    {
        $request = FriendRequest::where('user_id', $req->friend_id)->where('friend_id', Auth::user()->id)->first();

        $request->delete();
    }
}
