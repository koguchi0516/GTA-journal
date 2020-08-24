<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\ArticleTitle;
use App\Models\FavoriteArticle;
use App\User;

class MyPageController extends Controller
{
    public function showMyPage($user_id){
        $user_data = User::find($user_id);
        $article_title = new ArticleTitle;
        $article_data = $article_title -> where('user_id',$user_id) -> orderBy('updated_at','desc') -> get();
        $favo_title_id = $article_title -> where('user_id',$user_id) -> select('id') -> get() -> toArray();
        $favo_total = 0;
        $favo_count = 0;
        
        foreach($favo_title_id as $val){
            $favo_count = count(FavoriteArticle::where('article_title_id',$val) -> get() -> toArray());
            $favo_total += $favo_count;
        }
        
        $data = [
            'user_data' => $user_data,
            'article_data' => $article_data,
            'favo_total' => $favo_total,
        ];
        return view('users.my-page',compact('data'));
    }
}
