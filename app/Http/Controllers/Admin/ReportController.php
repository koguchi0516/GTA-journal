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
    public function report(Request $request,$article_title_id)
    {
        $this->validate($request,Report::$report_rule);
        $target_id = explode('-',$request -> input('target_content_id'));
        $user_id = 0;
        
        if(Auth::check()) $user_id = Auth::user()->id;
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
            
            default:
                abort(500);
                break;
        }
        
        $report = new Report;
        $report->user_id = $user_id;
        $report->target_id = $target_id[1];
        $report->content_type = $target_id[0];
        $report->reason_id = $request->report_content;
        
        if($target_id[0] == 2){
            $comment = Comment::find($target_id[1]);
            $report->article_title_id = $comment->article_title_id;
        }
        
        $report->save();
        $request->Session()->flash('info','報告が完了しました');
        
        switch($target_id[0]){
            case ($target_id[0] == 1 || $target_id[0] == 2):
                return redirect()->route('show_article.',['article_title_id' => $article_title_id]);
                break;
                
            case 3:
                return redirect()->route('friend_page');
                break;
                
            default:
                return redirect()->route('home');
                break;
        }
    }
    
    public function suspend(Request $request)
    {
        $suspending_user = new SuspendingUser;
        $suspending_user->user_id = $request->input('user_id');
        $suspending_user->reason_id = $request->input('report_content');
        $suspending_user->save();
        return back();
    }
    
    public function deleteAccount(Request $request,$user_id)
    {
        $article_title = new ArticleTitle;
        $article_title_id = $article_title->where('user_id',$user_id)->pluck('id');
        
        $user = User::find($user_id);
        
        RecruitingFriend::where('user_id',$user_id) -> delete();
        H3Tag::whereIn('article_title_id',$article_title_id)->delete();
        Ptag::whereIn('article_title_id',$article_title_id)->delete();
        ImgTag::whereIn('article_title_id',$article_title_id)->delete();
        FavoriteArticle::whereIn('article_title_id',$article_title_id)->orWhere('user_id',$user_id)->delete();
        Comment::where('user_id',$user_id)->delete();
        SuspendingUser::where('user_id',$user_id)->delete();
        Report::where('user_id',$user_id)->delete();
        \Storage::deletedirectory('users/' . $user->user_code);
        $article_title->where('user_id',$user_id)->delete();
        $user->find($user_id)->delete();
        
        return redirect()->route('home');
    }
}