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
    public function showHome(Request $request){
        if(Session('admin') !== 1) $request -> Session() -> put('admin',0);
        $article_data = ArticleTitle::orderBy('updated_at','desc') -> simplePaginate(5);
        return view('users.home',compact('article_data'));
    }
    
    public function showHomeWeekly(){
        $week_ago = date('y-m-d G:i:s',strtotime('-1 week',time()));
        $article_data = ArticleTitle::where('updated_at','>',$week_ago) -> withCount('favoriteArticle') -> orderBy('favorite_article_count','desc') -> simplePaginate(2);
        return view('users.home',compact('article_data'));
    }
    
    public function showHomeFavo(){
        if(!Auth::check()) return redirect ('/login');
        
        $article_data = ArticleTitle::select('article_titles.*')
        -> join('favorite_articles','article_titles.id','=','favorite_articles.article_title_id')
        -> where('favorite_articles.user_id',Auth::user() -> id)
        -> orderBy('favorite_articles.created_at','desc') -> simplePaginate(2);
        
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
        $article_data = ArticleTitle::where('category_id',$category_id) -> simplePaginate(2);
        return view('users.home',compact('article_data'));
    }
    
    public function searchCategory(Request $request){
        $category_id = $request -> input('category');
        $article_data = ArticleTitle::where('category_id',$category_id) -> simplePaginate(2);
        return view('users.home',compact('article_data'));
    }
    
}
