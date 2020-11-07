<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArticleTitle;
use App\Models\H3Tag;
use App\Models\Ptag;
use App\Models\ImgTag;
use Illuminate\Support\Facades\Auth;
use App\Models\SuspendingUser;
use Storage;

class ArticlePostController extends Controller
{
    public function showArticlePost(Request $request)
    {
        $suspend = SuspendingUser::where('user_id',Auth::user()->id)->exists();
        if($suspend) $request->Session()->flash('info','現在このアカウントで記事投稿はできません');
        return view('users.article-post');
    }
    
    public function showEditArticle(Request $request,$article_title_id)
    {
        $suspend = SuspendingUser::where('user_id',Auth::user()->id)->exists();
        if($suspend) $request->Session()->flash('info','現在このアカウントで記事更新はできません');
        
        $title_data = ArticleTitle::find($article_title_id);
        $contents = H3Tag::where('article_title_id',$article_title_id)->select('h3_content','turn')->get()->toArray();
        $contents = array_merge($contents , Ptag::where('article_title_id',$article_title_id)->select('p_content','turn')->get()->toArray());
        $contents = array_merge($contents , ImgTag::where('article_title_id',$article_title_id)->select('img_content','turn')->get()->toArray());
        $colle = collect($contents);
        $contents = $colle->sortBy('turn')->values();
        $content_types;
        
        foreach($contents as $content){
            foreach($content as $kye => $value){
                $content_types[] = $kye;
                }
            array_pop($content_types);
        }
        return view('users.article-edit',compact('content_types','contents','title_data'));
    }
    
    private function deleteSession($request)
    {
        $request-> Session()->forget('last_post_num');
        $request-> Session()->forget('post_num');
        $request-> Session()->forget('post_type');
    }
    
    private function deleteOldArticle($last_id)
    {
        H3Tag::where('article_title_id',$last_id)->delete();
        Ptag::where('article_title_id',$last_id)->delete();
        \Storage::deleteDirectory('users/' . Auth::user()->user_code . '/articles/article-' . $last_id);
        ImgTag::where('article_title_id',$last_id)->delete();
    }

    public function articlePost(Request $request)
    {
        $suspend = SuspendingUser::where('user_id',Auth::user()->id)->exists();
        if($suspend){
            return back();
        }
        
        $this->deleteSession($request);
        
        $title_id = $request->input('title-id');
        
        if($request->input('all-clear') !== null){
            return redirect()->route('create_article_page');
        }elseif($request->input('reset') !== null){
            $article_title_id = $title_id;
            return redirect()->route('edit_article_page.',['article_title_id => $article_title_id']);
        }
        
        $request->Session()->flash('last_post_num' , $request->input('last-post-num'));
        $post_type = $request->input('type');
        
        if(!isset($post_type)){
            $request->Session()->flash('info' , 'タイトルだけでは投稿できません');
            $request->Session()->flash('title',$request->input('title'));
            return view('users.article-post');
        }
        
        $post_num = $request->input('post-num');
        $request->Session()->put('post_num',$post_num);
        $request->Session()->put('post_type',$post_type);
        $this->validate($request,ArticleTitle::$article_post_rule);
        $title = $request->input('title');
        $category = $request->input('category');
        $count = count($post_type);
        
        for($i = 0 ; $i < $count ; $i++){
            $post_rule = ['post-'.$post_num[$i] => 'required'];
            $this->validate($request , $post_rule);
            $form = $request->input('post-'.$post_num[$i]);
            
            if($form == null){
                $post_rule = ['post-'.$post_num[$i] => 'required|file|max:3000|mimes:jpeg,png,jpg'];
                $this->validate($request , $post_rule);
                $form = $request->file('post-'.$post_num[$i]);
            }
            $posts[] = $form;
            $form = '';
        }
        
        $article_title = new ArticleTitle;
        
        if($title_id == Null){
            $article_title->user_id = Auth::user()->id;
            $article_title->title = $title;
            $article_title->category_id = $category;
            $article_title->save();
            $last_id = $article_title->id;
            
            $request->Session()->flash('info','投稿しました');
        }else{
            $article_title = $article_title->where('id',$title_id)->first();
            $updated_at = $article_title->updated_at;
            $article_title->title = $title;
            $article_title->category_id = $category;
            $article_title->save();
        
            $last_id = $article_title->id;            
            
            $this->deleteOldArticle($last_id);
            
            $request->Session()->flash('info','更新しました');
        }
        
        $data['posts'] = $posts;
        $data['lastId'] = $last_id;
        
        for($i = 0 ; $i < $count ; $i++){
            $data['i'] = $i;
            $method = $post_type[$i] . 'Post';
            $this->$method($data);
        }
            $request->Session()->forget('post_num');
            $request->Session()->forget('post_type');
            return redirect()->route('show_article.',['article_title_id' => $last_id]);
    }
    
    private function h3Post($data)
    {
        $h3_tag = new H3Tag;
        $h3_tag->article_title_id = $data['lastId'];
        $h3_tag->turn = $data['i'];
        $h3_tag->h3_content = ($data['posts'][$data['i']]);
        $h3_tag->save();
    }
    
    private function pPost($data)
    {
        $p_tag = new Ptag;
        $p_tag->article_title_id = $data['lastId'];
        $p_tag->turn = $data['i'];
        $p_tag->p_content = ($data['posts'][$data['i']]);
        $p_tag->save();
    }
    
    private function imgPost($data)
    {
        $img_tag = new imgTag;
        $img = $data['posts'][$data['i']];
        $target_path = 'users/' . Auth::user()->user_code . '/articles/article-' . $data['lastId'];
        $img_name ='turn-' . $data['i'] . '.' . $img->getClientOriginalExtension();
        $s3_img_path = $img->storeAs($target_path,$img_name,['ACL' => 'public-read']);
        
        $img_tag->article_title_id = $data['lastId'];
        $img_tag->turn = $data['i'];
        $img_tag->img_content = $s3_img_path;
        $img_tag->save();
    }
    
}