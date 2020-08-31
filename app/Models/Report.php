<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function user(){
        return $this -> belongsTo('App\User');
    }
    
    public function articleTitle(){
        return $this -> belongsTo('App\Models\ArticleTitle','target_id');
    }
    
    public static $report_rule = [
        'target_content_id' => 'required',
        'report_content' => 'required',
    ];
}