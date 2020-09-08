<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuspendingUser extends Model
{
    /*
    *リレーション
    */
    public function user(){
        return $this -> belongsTo('App\User');
    }
    
    public function Reason(){
        return $this -> belongsTo('App\Reason');
    }
}
