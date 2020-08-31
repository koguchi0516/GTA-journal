<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Rules\Psid;
use Illuminate\Support\Facades;
use Illuminate\Database\Eloquent\Models;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_code', 'password','icon','psid','profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /*
    *リレーション
    */
    public function recruitingFriend(){
        return $this -> hasMany('App\Models\RecruitingFriend');
    }
    
    public function articleTitle(){
        return $this -> hasMany('App\Models\ArticleTitle');
    }
    
    public function comment(){
        return $this -> hasMany('App\Models\Comment');
    }
    
    public function report(){
        return $this -> masMany('App\Models\Report');
    }
    
    /*
    *バリデーションルール
    */
    public static $change_icon_rule = [
        'newIcon' => 'required|file|max:2048|mimes:jpeg,png,jpg'
    ];
        
    public static $change_name_rule = [
        'change-name' => 'required|max:255'
    ];
        
    public static $change_psid_rule = [
        'change-psid' => 'required|between:3,16|alpha_dash'
    ];
    
    public static $change_profile_rule = [
        'change-profile'=>'max:255'
    ];
    
    public static $change_password_rule = [
        'new-password1' => 'required|min:8|alpha_num|different:old-password',
        'new-password2' => 'required|min:8|alpha_num|same:new-password1',
    ];


}
