<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;

class SettingController extends Controller
{
    public function showSettingPage(){
        return view('users.setting');
    }
    
    public function settingHandle(Request $request){
        $change_item = $request->input('setting-subbmit');
        
        switch($change_item){
            case 'アイコン変更':
                return view('users.setting',compact('change_item'));
                break;
                
            case '表示名変更':
                return view('users.setting',compact('change_item'));
                break;
                
            case 'PSID変更':
                return view('users.setting',compact('change_item'));
                break;
                
            case 'プロフィール変更':
                return view('users.setting',compact('change_item'));
                break;
                
            case 'パスワード変更':
                return view('users.setting',compact('change_item'));
                break;
        }
    }
}
