<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ArticleTitle;
use App\Models\FavoriteArticle;
use App\User;
use App\Models\SuspendingUser;

class MyPageController extends Controller
{
    public function showMyPage(Request $request,$user_id)
    {
        if(SuspendingUser::where('user_id',$user_id)->exists()) $request->Session()->flash('info','このアカウントは制限されています');
        
        $user_data = User::find($user_id);
        $article_title = new ArticleTitle;
        $article_data = $article_title->where('user_id',$user_id)->orderBy('updated_at','desc')->simplePaginate(10);
        $favo_title_id = $article_title->where('user_id',$user_id)->select('id')->get()->toArray();
        $favo_total = 0;
        $favo_count = 0;
        
        foreach($favo_title_id as $val)
        {
            $favo_count = count(FavoriteArticle::where('article_title_id',$val)->get()->toArray());
            $favo_total += $favo_count;
        }
        
        $data = [
            'user_data' => $user_data,
            'article_data' => $article_data,
            'favo_total' => $favo_total,
        ];
        
        if(Session('admin') == 1){
            $suspend_check = SuspendingUser::where('user_id',$user_id) -> exists();
            return view('admin.report-user-page',compact('data','suspend_check'));
        }
        return view('users.my-page',compact('data'));
    }
}
