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
        public function showArticlePost(){
            return view('users.article-post');
        }
        
    public function articlePost(Request $request){
        $type = $request -> input('type');
        if(!isset($type)){ 
            $info = 'タイトルだけでは投稿できません';
            return view('users.article-post',compact('info'));
        }
        
        $this -> validate($request,ArticleTitle::$article_post_rule);
        $title = $request -> input('title');
        $category = $request -> input('category');
        $post_num = $request -> input('post-num');
        $count = count($type);
        
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
        $article_title -> category = $category;
        $article_title -> save();
        
        $last_id = $article_title -> id;
        
        $data['posts'] = $posts;
        $data['lastId'] = $last_id;
        
        for($i = 0 ; $i < $count ; $i++){
            $data['i'] = $i;
            
            switch($type[$i]){
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
            $info = '投稿しました';
            return view('users.article-post',compact('info'));
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