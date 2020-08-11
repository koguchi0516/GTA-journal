<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        return view('users.home');
    }
    
    public function myPage(){
        return view('users.my-page');
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
