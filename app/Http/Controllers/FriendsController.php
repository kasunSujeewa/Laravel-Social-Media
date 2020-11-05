<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function removefr(Request $rq)
    {
        $fr1 = Auth::user()->friends->where('friend_id', $rq->friend_id)->first();
        $fr1->delete();
        $fr2 = Friends::where('user_id', $rq->friend_id)->where('friend_id', Auth::user()->id)->first();
        $fr2->delete();
    }
}
