<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function showMyPage(){
        $data = Auth::user();
        return view('users.my-page',['data'=>$data]);
    }
}
