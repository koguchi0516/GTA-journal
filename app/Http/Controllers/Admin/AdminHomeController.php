<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ArticleTitle;
use App\Models\Comment;
use App\Models\RecruitingFriend;
use App\User;
use App\Models\SuspendingUser;

class AdminHomeController extends Controller
{
    public function adminHome(){
        $user_count = User::count();
        $suspended_count = SuspendingUser::count();
        return view('admin.admin-home',compact('user_count','suspended_count'));
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
                $article_title = ArticleTitle::find($report -> target_id);
                if($article_title == Null){
                    Session() -> flash('info-'.$report_id,'記事削除済み');
                    return view('admin.report-article',compact('data'));
                }else{
                    return redirect('/article/'.$article_title -> id);
                }
                break;
                
            case 2:
                $comment = Comment::find($report -> target_id);
                if($comment == Null) $request -> Session() -> flash('info-'.$report_id,'コメント削除済み');
                if($comment !== Null) $data ['comment'] = $comment;
                return view('admin.report-comment',compact('data'));
                break;
                
            case 3:
                $friend = RecruitingFriend::find($report -> target_id);
                if($friend == Null) $request -> Session() -> flash('info-'.$report_id,'フレンド募集メッセージ削除済み');
                return view('admin.report-recrut-friend',compact('data','friend'));
                break;
        }
    }
    
}
