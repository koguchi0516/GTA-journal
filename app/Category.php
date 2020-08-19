<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articleTitle(){
        return $this -> hasOne('App\Models\ArticleTitle');
    }
}
