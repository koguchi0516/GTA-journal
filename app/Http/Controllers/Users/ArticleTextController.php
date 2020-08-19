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

class ArticleTextController extends Controller
{
    
    public function showArticle(Request $request,$article_title_id){
        $title_data = ArticleTitle::find($article_title_id);
        $contents = H3Tag::where('article_title_id',$article_title_id) -> select('h3_content','turn') -> get() -> toArray();
        $contents = array_merge($contents , Ptag::where('article_title_id',$article_title_id) -> select('p_content','turn') -> get() -> toArray());
        $contents = array_merge($contents , ImgTag::where('article_title_id',$article_title_id) -> select('img_content','turn') -> get() -> toArray());
        $comments = Comment::where('article_title_id',$article_title_id) -> get();
        $test = collect($contents);
        $contents = $test -> sortBy('turn') -> values();
        $content_types;
        
        foreach($contents as $content){
            foreach($content as $kye => $value){
                $content_types[] = $kye;
                }
            array_pop($content_types);
        }
        
        $data = [
            'title_data' => $title_data,
            'comments' => $comments,
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
        return redirect('/article/'.$article_title_id);
        }else{
            $favo_article -> delete();
        }
        return redirect('/article/'.$article_title_id);
    }
    
    public function deleteArticle(Request $request){}
    
    public function editArticle(Request $request){}
    
    public function toComment(Request $request,$article_title_id){
        $this -> validate($request,Comment::$comment_rule);
        
        $comment = new Comment;
        $comment -> user_id = Auth::user() -> id;
        $comment -> article_title_id = $article_title_id;
        $comment -> comment_content = $request -> input('comment-post');
        $comment -> save();
        
        return redirect('/article/'.$article_title_id);
    }
}