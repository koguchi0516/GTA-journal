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

class ArticleTextController extends Controller
{
    public function showArticle(Request $request,$article_title_id){
        $title_data = ArticleTitle::find($article_title_id);
        $contents = H3Tag::where('article_title_id',$article_title_id) -> select('h3_content','turn') -> get() -> toArray();
        $contents = array_merge($contents , Ptag::where('article_title_id',$article_title_id) -> select('p_content','turn') -> get() -> toArray());
        $contents = array_merge($contents , ImgTag::where('article_title_id',$article_title_id) -> select('img_content','turn') -> get() -> toArray());
        $comments = Comment::where('article_title_id',$article_title_id) -> get();
        $colle = collect($contents);
        $contents = $colle -> sortBy('turn') -> values();
        $content_types;
        $favo_article = '';
        
        if(Auth::check()) $favo_article = FavoriteArticle::where('user_id',Auth::user() -> id) -> where('article_title_id',$article_title_id) -> exists();
        
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
        
        return view('users.article',compact('data','contents','content_types'));
    }
    
    public function favoArticle($article_title_id){
        $favo_article = FavoriteArticle::where('user_id',Auth::user() -> id) -> where('article_title_id',$article_title_id) -> first();
        
        if($favo_article == Null){
        $favo_article = new FavoriteArticle;
        $favo_article -> user_id = Auth::user() -> id;
        $favo_article -> article_title_id = $article_title_id;
        $favo_article -> save();
        return back();
        }else{
            $favo_article -> delete();
        }
        return back();
    }
    
    public function toComment(Request $request,$article_title_id){
        $this -> validate($request,Comment::$comment_rule);
        
        $comment = new Comment;
        $comment -> user_id = Auth::user() -> id;
        $comment -> article_title_id = $article_title_id;
        $comment -> comment_content = $request -> input('comment-post');
        $comment -> save();
        $request -> Session() -> flash('info','コメントを投稿しました');
        return back();
    }
    
    public function deleteComment(Request $request,$content_type,$content_id){
        switch($content_type){
            case 'article':
                ArticleTitle::destroy($content_id);
                H3Tag::where('article_title_id',$content_id) -> delete();
                Ptag::where('article_title_id',$content_id) -> delete();
                FavoriteArticle::where('article_title_id',$content_id) -> delete();
                Comment::where('article_title_id',$content_id) -> delete();
                
                $img_count = ImgTag::where('article_title_id',$content_id) -> pluck('img_content');
                for($i = 0 ; $i < count($img_count) ; $i++){
                $delete_name = storage_path().'/app/public/article-imgs/'.$img_count[$i];
                \File::delete($delete_name);
                }
                ImgTag::where('article_title_id',$content_id) -> delete();
                return redirect('/mypage/'.Auth::user() -> id);
                break;
                
            case 'comment':
                Comment::destroy($content_id);
                break;
                
            case 'friend':
                RecruitingFriend::destroy($content_id);
                break;
        }
        $request -> Session() -> flash('info','コメントを削除しました');
        return back();
    }
}