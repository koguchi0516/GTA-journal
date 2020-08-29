<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function adminHome(){
        return view('admin.admin-home');
    }
    
    public function reportList(){
        return view('admin.report-list');
    }
    
    public function reportUser(){
        return view('admin.report-user');
    }
    
    public function reportArticle(){
        return view('admin.report-article');
    }
    
    public function reportComment(){
        return view('admin.report-comment');
    }
    
}
