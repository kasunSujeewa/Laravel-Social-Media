<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;

class FriendsController extends Controller
{
    public function removefr(Request $rq)
    {
       if(Friends::where('user_id',$rq->friend_id))
       {
           Friend::where('friend_id',Auth::user()->id)->delete();
       }
       elseif(Friends::where('friend_id',$rq->friend_id)){
        Friend::where('user_id',Auth::user()->id)->delete(); 
       } 
    }
}
