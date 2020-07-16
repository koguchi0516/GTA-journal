<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('users.home');
    }
    public function mypage(){
        return view('users.my-page');
    }
}
