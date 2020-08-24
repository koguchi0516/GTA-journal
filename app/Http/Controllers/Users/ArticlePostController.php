<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArticleTitle;
use App\Models\H3Tag;
use App\Models\Ptag;
use App\Models\ImgTag;
use Illuminate\Support\Facades\Auth;

class ArticlePostController extends Controller
{
    public function showArticlePost(Request $request){
        return view('users.article-post');
    }
    
    public function showEditArticle(Request $request,$article_title_id){
        $title_data = ArticleTitle::find($article_title_id);
        $contents = H3Tag::where('article_title_id',$article_title_id) -> select('h3_content','turn') -> get() -> toArray();
        $contents = array_merge($contents , Ptag::where('article_title_id',$article_title_id) -> select('p_content','turn') -> get() -> toArray());
        $contents = array_merge($contents , ImgTag::where('article_title_id',$article_title_id) -> select('img_content','turn') -> get() -> toArray());
        $colle = collect($contents);
        $contents = $colle -> sortBy('turn') -> values();
        // $request -> Session() -> put('last_post_num',count($contents));
        $content_types;
        
        foreach($contents as $content){
            foreach($content as $kye => $value){
                $content_types[] = $kye;
                }
            array_pop($content_types);
        }
        return view('users.article-edit',compact('content_types','contents','title_data'));
    }
        
    public function articlePost(Request $request){
        
        if($request -> input('all-clear') !== null){
        $request -> Session() -> forget('last_post_num');
        $request -> Session() -> forget('post_num');
        $request -> Session() -> forget('post_type');
        return redirect('/article-post');
            
        }elseif($request -> input('reset') !== null){
            $request -> Session() -> forget('last_post_num');
            $request -> Session() -> forget('post_num');
            $request -> Session() -> forget('post_type');
            $article_title_id = $request -> input('title-id');
            return redirect('/edit/'.$article_title_id);
        }
        
        $request -> Session() -> forget('post_num');
        $request -> Session() -> forget('post_type');
        $request -> Session() -> flash('last_post_num' , $request -> input('last-post-num'));
        $post_type = $request -> input('type');
        
        if(!isset($post_type)){ 
            $request -> Session() -> flash('info' , 'タイトルだけでは投稿できません');
            return view('users.article-post');
        }
        
        $post_num = $request -> input('post-num');
        $request -> Session() -> put('post_num',$post_num);
        $request -> Session() -> put('post_type',$post_type);
        $this -> validate($request,ArticleTitle::$article_post_rule);
        $title = $request -> input('title');
        $category = $request -> input('category');
        $count = count($post_type);

        for($i = 0 ; $i < $count ; $i++){
            $post_rule = ['post-'.$post_num[$i] => 'required'];
            $this -> validate($request , $post_rule);
            $form = $request -> input('post-'.$post_num[$i]);
            
            if($form == null){
                $post_rule = ['post-'.$post_num[$i] => 'required|file|max:3000|mimes:jpeg,png,jpg'];
                $this -> validate($request , $post_rule);
                $form = $request -> file('post-'.$post_num[$i]);
            }
            $posts[] = $form;
            $form = '';
        }
        
        $article_title = new ArticleTitle;
        $article_title -> user_id = Auth::user() -> id;
        $article_title -> title = $title;
        $article_title -> category_id = $category;
        $article_title -> save();
        
        $last_id = $article_title -> id;
        $data['posts'] = $posts;
        $data['lastId'] = $last_id;
        
        for($i = 0 ; $i < $count ; $i++){
            $data['i'] = $i;
            switch($post_type[$i]){
                case 'h3':
                    $this -> h3Post($data);
                    break;
                
                case 'p':
                    $this -> pPost($data);
                    break;
                
                case 'img':
                    $this -> imgPost($data);
                    break;
            }
        }
            $request -> Session() -> forget('post_num');
            $request -> Session() -> forget('post_type');
            $request -> Session() -> flash('info','投稿しました');
            // 更新の場合はここで過去の投稿削除
            return view('users.article-post');
    }
    
    public function h3Post($data){
        $h3_tag = new H3Tag;
        $h3_tag -> article_title_id = $data['lastId'];
        $h3_tag -> turn = $data['i'];
        $h3_tag -> h3_content = ($data['posts'][$data['i']]);
        $h3_tag -> save();
    }
    
    public function pPost($data){
        $p_tag = new Ptag;
        $p_tag -> article_title_id = $data['lastId'];
        $p_tag -> turn = $data['i'];
        $p_tag -> p_content = ($data['posts'][$data['i']]);
        $p_tag -> save();
    }
    
    public function imgPost($data){
        $img_tag = new imgTag;
        $img = $data['posts'][$data['i']]; 
        $img_name = Auth::user() -> user_code . '-' .$data['lastId'] . '-' . $data['i'] . '.' . $img -> getClientOriginalExtension();
        $target_path = public_path('article-imgs');
        $img -> move($target_path,$img_name);
        
        $img_tag -> article_title_id = $data['lastId'];
        $img_tag -> turn = $data['i'];
        $img_tag -> img_content = $img_name;
        $img_tag-> save();
    }
    
}