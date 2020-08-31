<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ArticleTitle;
use App\Models\Comment;
use App\Models\RecruitingFriend;

class AdminHomeController extends Controller
{
    public function adminHome(){
        return view('admin.admin-home');
    }
    
    public function reportList(){
        $reports = Report::all() -> sortByDesc('created_at');
        return view('admin.report-list',compact('reports'));
    }
    
    public function reportUser(){
        return view('admin.report-user');
    }
    
    public function reportDetail(Request $request,$report_id){
        $report = Report::find($report_id);
        $report_count = Report::where('user_id',$report -> user_id) -> count();
        $data = [
            'report' => $report,
            'report_id' => $report_id,
            'report_count' => $report_count,
        ];
        
        switch($report -> content_type){
            case 1:
                $target_content = ArticleTitle::find($report -> user_id);
                break;
                
            case 2:
                $comment = Comment::find($report -> target_id);
                if($comment == Null) $request -> Session() -> flash('info-'.$report_id,'削除済み');
                if($comment !== Null) $data ['comment'] = $comment;
                return view('admin.report-comment',compact('data'));
                break;
                
            case 3:
                $target_content = RecruitingFriend::find($report -> user_id);
                break;
        }
        print_r($target_content);
        
    }
    
}
