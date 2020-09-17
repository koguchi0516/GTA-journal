<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Comment;
use App\Models\SuspendingUser;
use App\User;
use App\Models\ArticleTitle;
use App\Models\H3Tag;
use App\Models\Ptag;
use App\Models\ImgTag;
use App\Models\FavoriteArticle;
use App\Models\RecruitingFriend;

class ReportController extends Controller
{
    public function showAdmin(Request $request){}
    
    public function report(Request $request,$article_title_id){
        $this -> validate($request,Report::$report_rule);
        $target_id = explode('-',$request -> input('target_content_id'));
        $user_id = 0;
        
        if(Auth::check()) $user_id = Auth::user() -> id;
        switch($target_id[0]){
            case 'article':
                $target_id[0] = 1;
                break;
            
            case 'comment':
                $target_id[0] = 2;
                break;
                
            case 'friend':
                $target_id[0] = 3;
                break;
        }
        
        $report = new Report;
        $report -> user_id = $user_id;
        $report -> target_id = $target_id[1];
        $report -> content_type = $target_id[0];
        $report -> reason_id = $request -> report_content;
        
        if($target_id[0] == 2){
            $comment = Comment::find($target_id[1]);
            $report -> article_title_id = $comment -> article_title_id;
        }
        
        $report -> save();
        $request -> Session() -> flash('info','報告が完了しました');
        
        switch($target_id[0]){
            case ($target_id[0] == 1 || $target_id[0] == 2):
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
    
    public function suspend(Request $request){
        $suspending_user = new SuspendingUser;
        $suspending_user -> user_id = $request -> input('user_id');
        $suspending_user -> reason_id = $request -> input('report_content');
        $suspending_user -> save();
        return back();
    }
    
    
    public function deleteAccount(Request $request,$user_id){
        $suspending_user = SuspendingUser::where('user_id',$user_id) -> get();

        $user = User::find($user_id);
        if($user -> icon !== 'default-icon.jpg'){
            $delete_img = storage_path().'/app/public/user-icons/'.$user -> icon;
            \File::delete($delete_img);
        }
        
        $article_title = new ArticleTitle;
        $article_title_id = $article_title -> where('user_id',$user_id) -> pluck('id');
        
        $img_tag = ImgTag::whereIn('article_title_id',$article_title_id) -> get();
        if(isset($img_tag)){
            foreach($img_tag as $val){
                $delete_img = storage_path().'/app/public/article-imgs/'.$val -> img_content;
                \File::delete($delete_img);
            }
        }
        
        RecruitingFriend::where('user_id',$user_id) -> delete();
        H3Tag::whereIn('article_title_id',$article_title_id) -> delete();
        Ptag::whereIn('article_title_id',$article_title_id) -> delete();
        ImgTag::whereIn('article_title_id',$article_title_id) -> delete();
        FavoriteArticle::whereIn('article_title_id',$article_title_id) -> orWhere('user_id',$user_id) -> delete();
        SuspendingUser::where('user_id',$user_id)-> delete();
        Report::where('user_id',$user_id) -> delete();
        $article_title -> where('user_id',$user_id) -> delete();
        $user -> find($user_id) -> delete();
        
        return redirect('/admin/home');
    }
}