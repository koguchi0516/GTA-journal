<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    public function SuspendingUser(){
        return $this -> hasMany('App\Models\SuspendingUser');
    }
    
    public function Report(){
        return $this -> hasMany('App\Models\Report');
    }
}
