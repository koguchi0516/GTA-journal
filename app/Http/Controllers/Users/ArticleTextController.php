<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArticleTitle;
use App\Models\H3Tag;
use App\Models\Ptag;
use App\Models\ImgTag;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Http\Controllers\Users\Route;
use App\Models\FavoriteArticle;
use App\Models\RecruitingFriend;
use App\Models\SuspendingUser;
use App\Models\Report;
use App\User;

class ArticleTextController extends Controller
{
    public function showArticle(Request $request,$article_title_id)
    {
        $title_data = ArticleTitle::find($article_title_id);
        $contents = H3Tag::where('article_title_id',$article_title_id)->select('h3_content','turn')->get()->toArray();
        $contents = array_merge($contents , Ptag::where('article_title_id',$article_title_id)->select('p_content','turn')->get()->toArray());
        $contents = array_merge($contents , ImgTag::where('article_title_id',$article_title_id)->select('img_content','turn')->get()->toArray());
        $comments = Comment::where('article_title_id',$article_title_id)->get();
        $colle = collect($contents);
        $contents = $colle->sortBy('turn')->values();
        $content_types;
        $favo_article = '';
        
        if(Auth::check()) $favo_article = FavoriteArticle::where('user_id',Auth::user()->id)->where('article_title_id',$article_title_id)->exists();
        
        foreach($contents as $content){
            foreach($content as $kye => $value){
                $content_types[] = $kye;
                }
            array_pop($content_types);
        }
        
        $data = [
            'title_data' => $title_data,
            'comments' => $comments,
            'favo_article' => $favo_article,
        ];
        
        if(Session('admin') == 1){
            if(Session('data') !== Null)$data = array_merge($data,Session('data'));
            return view('admin.report-article',compact('data','contents','content_types'));
        }
        
        return view('users.article',compact('data','contents','content_types'));
    }
    
    public function favoArticle(Request $request,$article_title_id)
    {
        $suspend = SuspendingUser::where('user_id',Auth::user()->id)->exists();
        if($suspend){
            $request->Session()->flash('info','現在このアカウントでいいね機能は利用できません');
            return back();
        }
        
        $favo_article = FavoriteArticle::where('user_id',Auth::user()->id)->where('article_title_id',$article_title_id)->first();
        
        if($favo_article == Null){
        $favo_article = new FavoriteArticle;
        $favo_article->user_id = Auth::user()->id;
        $favo_article->article_title_id = $article_title_id;
        $favo_article->save();
        return back();
        }else{
            $favo_article -> delete();
        }
        return back();
    }
    
    public function toComment(Request $request,$article_title_id)
    {
        $suspend = SuspendingUser::where('user_id',Auth::user()->id)->exists();
        if($suspend){
            $request->Session()->flash('info','現在このアカウントでコメントはできません');
            return back();
        }
        
        $this->validate($request,Comment::$comment_rule);
        
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->article_title_id = $article_title_id;
        $comment->comment_content = $request->input('comment-post');
        $comment->save();
        $request->Session()->flash('info','コメントを投稿しました');
        return back();
    }
    
    private function deleteArticleData($content_id)
    {
        $user_id = ArticleTitle::where('id',$content_id)->value('user_id');
        $user_code = User::find($user_id)->value('user_code');
        
        ArticleTitle::destroy($content_id);
        H3Tag::where('article_title_id',$content_id)->delete();
        Ptag::where('article_title_id',$content_id)->delete();
        FavoriteArticle::where('article_title_id',$content_id)->delete();
        Comment::where('article_title_id',$content_id)->delete();
        Report::where('article_title_id',$content_id)->delete();
        \Storage::deleteDirectory('users/' . $user_code . '/articles/article-' . $content_id);        
    }
    
    public function deleteCoctent(Request $request,$content_type,$content_id)
    {
        switch($content_type){
            case 'article':
                $this->deleteArticleData($content_id);
                
                $img_count = ImgTag::where('article_title_id',$content_id)->pluck('img_content');
                ImgTag::where('article_title_id',$content_id)->delete();
                Report::where('target_id',$content_id)->where('content_type','1')->delete();
                
                if(Auth::check()){
                    return redirect()->route('mypage.',['user_id' => Auth::user() -> id]);
                }
                break;
                
            case 'comment':
                Comment::destroy($content_id);
                Report::where('target_id',$content_id)->where('content_type','2')->delete();
                break;
                
            case 'friend':
                RecruitingFriend::destroy($content_id);
                Report::where('target_id',$content_id)->where('content_type','3')->delete();
                break;
                
            default:
                abort(500);
                break;
        }
        
        $request->Session()->flash('info','コンテンツを削除しました');
        
        if(Auth::check()){
            return redirect()->back();
        }else{
            return redirect()->route('admin_report_list');
        }
    }
}