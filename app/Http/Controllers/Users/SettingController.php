<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Input;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function showSettingPage(){
        return view('users.setting');
    }
    
    public function settingHandle(Request $request){
        global $input_data,$users;
        $input_data = $request;
        $change_value = $request->input('setting-subbmit');
        $users = User::find(Auth::user()->id);
        
        switch($change_value){
            case 'アイコン変更':
                return $this -> changeIcon();
                break;
                
            case '表示名変更':
                return $this -> changeName();
                break;
                
            case 'PSID変更':
                return $this -> changePsid();
                break;
                
            case 'プロフィール変更':
                return $this -> changeProfile();
                break;
                
            case 'パスワード変更':
                $request->input('password');
                return $this -> changePassword();
                break;
        }
    }
    
    public function changeIcon(){
        global $input_data,$users; //grobalやめてconfig使用
        $this -> validate($input_data,['newIcon'=>'required|file|max:2048|mimes:jpeg,png,jpg']);
        $new_icon = $input_data -> file('newIcon');
        $new_icon_name = Auth::user() -> user_id. '-icon' . '.' .$new_icon -> getClientOriginalExtension();
        $target_path = public_path('user-icons');
        $new_icon -> move($target_path,$new_icon_name);
                
        $users -> icon = $new_icon_name;
        $users -> save();
        $message = 'アイコン';
        return view('users.setting',compact('message')); //この行重複、親関数作ってまとめる方がいい？
        // return redirect('/setting'); 変更内容が随時反映されるが$messageを渡せない
    }
    
    public function changeName(){
        global $input_data,$users;
        $this->validate($input_data,['change-name'=>'required|max:255']);
        $new_name = $input_data->input('change-name');
        $users -> name = $new_name;
        $users -> save();
        $message = '表示名';
        return view('users.setting',compact('message'));
    }
    
    public function changePsid(){
        global $input_data,$users;
        $new_psid = $input_data->input('change-psid');
        if($new_psid == ''){
            $users -> psid = '';
        }else{
            $this->validate($input_data,['change-psid'=>'max:20|alpha_dash']);
            $users -> psid = $new_psid;
        }
        $users ->save();
        $message = 'PSID';
        return view('users.setting',compact('message'));
    }
    
    public function changeProfile(){
        global $input_data,$users;
        $new_profile = $input_data -> input('change-profile');
        if($new_profile == ''){
            $users -> profile = '';
        }else{
            $this -> validate($input_data,['change-profile'=>'max:255']);
            $users -> profile = $new_profile;
        }
        $users -> save();
        $message = 'プロフィール';
        return view('users.setting',compact('message'));
    }
    
    public function changePassword(){
        global $input_data,$users;
        return view('users.setting',compact('message'));
    }
    
}
