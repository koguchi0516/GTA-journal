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

class HomeController extends Controller
{
    public function adminHome(Request $request)
    {
        $data = [
            'user_count' => User::count(),
            'suspended_count' => SuspendingUser::count(),
            'report_count' => Report::count(),
        ];
        
        $request -> Session() -> put('admin',1);
        return view('admin.admin-home',compact('data'));
    }
    
    public function reportList()
    {
        $reports = Report::orderBy('created_at','desc')->simplePaginate(20);
        return view('admin.report-list',compact('reports'));
    }
    
    public function reportUser()
    {
        $suspends = SuspendingUser::orderBy('created_at','desc')->simplePaginate(10);
        return view('admin.report-user',compact('suspends'));
    }
    
    public function reportDetail(Request $request,$report_id)
    {
        $report = Report::find($report_id);
        $report_count = Report::where('user_id',$report->user_id)->count();
        $request -> Session() -> put('report_id',$report_id);
        $data = [
            'report' => $report,
            'report_id' => $report_id,
            'report_count' => $report_count,
        ];
        
        switch($report -> content_type){
            case 1:
                $article_title = ArticleTitle::find($report->target_id);

                $request->Session()->put('data',$data);
                return redirect()->route('show_article.',['article_title_id' => $article_title->id]);
                break;
                
            case 2:
                $comment = Comment::find($report->target_id);
                
                if($comment !== Null){
                    $data['comment'] = $comment;
                    $request->Session()->put('data',$data);
                }
                return view('admin.report-comment',compact('data'));
                break;
                
            case 3:
                $friend = RecruitingFriend::find($report->target_id);
                    
                $request->Session()->put('data',$data);
                return view('admin.report-recrut-friend',compact('data','friend'));
                break;
                
            default:
                abort(500);
                break;
        }
    }
    
    public function release(Request $request,$user_id)
    {
        SuspendingUser::where('user_id',$user_id)->delete();
        return back();
    }
    
}
