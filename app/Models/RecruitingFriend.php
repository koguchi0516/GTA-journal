<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RecruitingFriend extends Model
{
    public static $recruite_friend_rule = [
        'psid' => 'between:3,16|alpha_dash',
        'friend-message' => 'required|max:500',
    ];
}
