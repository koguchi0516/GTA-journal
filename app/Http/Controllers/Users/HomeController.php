<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        // if(Auth::check){
        //     $request -> session() -> put(['user_id' => 'Auth::user -> user_id']);
        // }
        return view('users.home');
    }
    public function myPage(){
        return view('users.my-page');
    }
    
    public function articlePost(){
        return view('users.article-post');
    }
    
    public function article(){
        return view('users.article');
    }
    
    public function recruteFriend(){
        return view('users.recrute-friend');
    }
    
    public function setting(){
        return view('users.setting');
    }
}
