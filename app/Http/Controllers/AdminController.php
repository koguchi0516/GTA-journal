<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class AdminController extends Controller
{
    public function showAdmin(Request $request){}
    
    public function report(Request $request,$article_title_id){
        $this -> validate($request,Report::$report_rule);
        $target_content_id = explode('-',$request -> input('target_content_id'));
        $repoeter_id = 0;
        
        if(Auth::check()) $repoeter_id = Auth::user() -> id;
        
        switch($target_content_id[0]){
            case 'article':
                $target_content_id[0] = 1;
                break;
            
            case 'comment':
                $target_content_id[0] = 2;
                break;
                
            case 'friend':
                $target_content_id[0] = 3;
                break;
        }
        
        $report = new Report;
        $report -> repoeter_id = $repoeter_id;
        $report -> target_content_id = $target_content_id[1];
        $report -> content_type = $target_content_id[0];
        $report -> report_content = $request -> report_content;
        $report -> save();
        $request -> Session() -> flash('info','報告が完了しました');
        
        switch($target_content_id[0]){
            case ($target_content_id[0] == 1 || $target_content_id[0] == 2):
                return redirect('/article/'.$article_title_id);
                break;
                
            case 3:
                return redirect('/recrut-friend');
                break;
                
            default:
                return redirect('/home');
                break;
        }
    }
    
    public function reportList(Request $request){}
    public function reportArticle(Request $request){}
    public function reportComment(Request $request){}
    public function accountSuspension(Request $request){}
}
