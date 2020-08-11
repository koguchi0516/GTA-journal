<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class AdminController extends Controller
{
    public function showAdmin(Request $request){}
    
    public function report(Request $request){
        $this -> validate($request,Report::$report_rule);
        $content_type = $request -> content_type;
        
        $report = new Report;
        $report -> repoeter_id = Auth::user() -> user_code;
        $report -> target_content_id = $request -> target_content_id;
        $report -> content_type = $content_type;
        $report -> report_content = $request -> report_content;
        $report -> save();
        
        switch($content_type){
            case ($content_type == 1 || $content_type == 2):
                return redirect('/hogehogehoge'.$content_type);/*記事と記事コメントの報告処理*/
                break;
                
            case 3:
                return redirect('/recrut-friend');
                break;
                
            default:
                return redirect('/hoge');
                break;
        }
        
    }
    
    public function reportList(Request $request){}
    public function reportArticle(Request $request){}
    public function reportComment(Request $request){}
    public function accountSuspension(Request $request){}
}
