<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class RecruitingFriend extends Model
{
    
    public function user(){
        return $this -> belongsTo('App\User');
    }
    
    public function purpose(){
        return $this -> belongsTo('App\Purpose');
    }

    public static $recruit_friend_rule = [
        'psid' => 'between:3,16|alpha_dash',
        'friend-message' => 'required|max:500',
    ];
    
}
