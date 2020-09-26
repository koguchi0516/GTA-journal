<?php
namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecruitingFriend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\SuspendingUser;

class RecruitFriendController extends Controller
{
    public function recrutShow(Request $request){
        $recruiting_friend = RecruitingFriend::orderBy('created_at','desc') -> simplePaginate(20);
        if(Auth::check()){
            $suspend = SuspendingUser::where('user_id',Auth::user() -> id) -> exists();
            if($suspend) $request -> Session() -> flash('info','現在このアカウントでフレンド募集はできません');
        }
        return view('users.recrut-friend',compact('recruiting_friend'));
    }
    
    public function recrutMessage(Request $request){
        $suspend = SuspendingUser::where('user_id',Auth::user() -> id) -> exists();
        if($suspend) return back();
        
        $timestamp = time();
        $this -> validate($request,RecruitingFriend::$recruit_friend_rule);
        
        $user_id = Auth::user() -> id;
        $purpose = $request -> input('purpose');
        $psid = $request -> input('psid');
        $expiration_date = $timestamp + $request -> input('expiration-date');
        $friend_message = $request -> input('friend-message');
        
        $recruiting_friend = new RecruitingFriend;
        $recruiting_friend -> user_id = $user_id;
        $recruiting_friend -> purpose_id = $purpose;
        $recruiting_friend -> psid = $psid;
        $recruiting_friend -> expiration_date = $expiration_date;
        $recruiting_friend -> friend_message = $friend_message;
        $recruiting_friend -> save();
        
        $request -> Session() -> flash('info','投稿しました');
        return back();
    }
}