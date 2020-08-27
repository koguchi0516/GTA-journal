<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\ArticleTitle;
use App\Models\FavoriteArticle;
use App\User;

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
    
    public function searchUser(Request $request){
        $this -> validate($request,['user-data' => 'required']);
        $user_data = $request -> input('user-data');
        $user_id = User::where('user_code',$user_data) -> value('id');
        if($user_id == Null) $user_id = User::where('name',$user_data) -> value('id');
        
        if(isset($user_id)){
            return redirect('/mypage/'.$user_id);
        }else{
            $request -> Session() -> flash('info','このユーザーは存在しません');
            return back();
        }
    }
    
    public function linkChcategory(Request $request,$category_id){
        $article_data = ArticleTitle::where('category_id',$category_id) -> get();
        return view('users.home',compact('article_data'));
    }
    
    public function searchCategory(Request $request){
        $category_id = $request -> input('category');
        $article_data = ArticleTitle::where('category_id',$category_id) -> get();
        return view('users.home',compact('article_data'));
    }
    
}
