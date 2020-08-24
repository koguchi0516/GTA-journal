<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\ArticleTitle;
use App\Models\FavoriteArticle;

class HomeController extends Controller
{
    public function showHome(){
        $article_data = ArticleTitle::orderBy('updated_at','desc') -> get();
        return view('users.home',compact('article_data'));
    }
    
    public function showHomeWeekly(){
        print('週間のいいねランキング');
    //     $week_ago = date('y-m-d G:i:s',strtotime('-1 week',time()));
    //     $favo_title_id = FavoriteArticle::where('updated_at','>',$week_ago) -> select('article_title_id') -> orderBy('article_title_id', 'desc') -> get() -> toArray();
    //     $favo_title_id = array_column($favo_title_id,'article_title_id');
    //     $test = [];
    //     $article_data = [];
        
    //     foreach($favo_title_id as $val){
    //         if(!in_array($val,$test)) $test[] = $val;
    //     }
        
    //     $article_data = ArticleTitle::find($test) -> join('favoriteArticle','article_titles.id','=','favorite_articles.article_title_id') -> orderBy('');
        
    //     print_r($article_data);
    //     return view('users.home',compact('article_data'));
    }
    
    public function showHomeFavo(){
        if(!Auth::check()) return redirect ('/login');
        
        $article_data = ArticleTitle::select('article_titles.*')
        -> join('favorite_articles','article_titles.id','=','favorite_articles.article_title_id')
        -> where('favorite_articles.user_id',Auth::user() -> id)
        -> orderBy('favorite_articles.created_at','desc') -> get();
        
        return view('users.home',compact('article_data'));
    }
    
}
