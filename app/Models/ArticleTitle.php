<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTitle extends Model
{
    public static $article_post_rule = [
        'category' => 'required',
        'title' => 'required|max:255',
    ];
}