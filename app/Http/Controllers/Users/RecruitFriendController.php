<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\RecruitingFriend;
use Illuminate\Support\Facades\Auth;

class RecruitFriendController extends Controller
{
    public function showRecruitFriend(){
        return view('users.recrute-friend');
    }
    
    public function friendMessage(Request $request){
        $timestamp = time();
        $this -> validate($request,RecruitingFriend::$recruite_friend_rule);
        
        $user_id = Auth::user() -> user_id;
        $purpose = $request -> input('purpose');
        $expiration_date = $timestamp + $request -> input('expiration-date');
        $friend_message = $request -> input('friend-message');
        
        $recruiting_friend = new RecruitingFriend;
        $recruiting_friend -> user_id = $user_id;
        $recruiting_friend -> purpose = $purpose;
        $recruiting_friend -> expiration_date = $expiration_date;
        $recruiting_friend -> friend_message = $friend_message;
        
        $recruiting_friend -> save();
        
        return view('users.recrute-friend');
    }
    
    public function messageDisplay(Request $request){}
}
