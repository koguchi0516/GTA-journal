<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteArticle extends Model
{
    public function articleTitle(){
        return $this -> belongsTo('App\Models\FavoriteArticle');
    }
}
