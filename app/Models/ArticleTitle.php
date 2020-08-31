<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTitle extends Model
{
    public function user(){
        return $this -> belongsTo('App\User');
    }
    
    public function category(){
        return $this -> belongsTo('App\Category');
    }
    
    public function favoriteArticle(){
        return $this -> hasMany('App\Models\FavoriteArticle');
    }
    
    public function report(){
        return $this -> hasOne('App\Models\Report');
    }
    
    public static $article_post_rule = [
        'category' => 'required',
        'title' => 'required|max:255',
    ];
}