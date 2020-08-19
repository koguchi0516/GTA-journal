<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    public function articleTitle(){
        return $this -> hasOne('App\Models\Comment');
    }
}
