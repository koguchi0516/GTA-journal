<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Input;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function showSettingPage(){
        return view('users.setting');
    }
    
    public function settingHandle(Request $request){
        $input_data = $request;
        $change_value = $request->input('setting-subbmit');
        $users = User::find(Auth::user()->id);
        
        switch($change_value){
            case 'アイコン変更':
                $message = $this -> changeIcon( $request,$users );
                break;
                
            case '表示名変更':
                $message = $this -> changeName( $request,$users );
                break;
                
            case 'PSID変更':
                $message = $this -> changePsid( $request,$users );
                break;
                
            case 'プロフィール変更':
                $message = $this -> changeProfile( $request,$users );
                break;
                
            case 'パスワード変更':
                $message = $this -> changePassword( $request,$users );
                break;
        }
        return view('users.setting',compact('message'));
    }
    
    public function changeIcon(Request $request,$users){
        $this -> validate($request,user::$change_icon_rule);
        $new_icon = $request -> file('newIcon');
        $new_icon_name = Auth::user() -> user_id. '-icon' . '.' .$new_icon -> getClientOriginalExtension();
        $target_path = public_path('user-icons');
        $new_icon -> move($target_path,$new_icon_name);
        
        $users -> icon = $new_icon_name;
        $users -> save();
        return $message = var_dump($data = $request->session()->all());
    }
    
    public function changeName(Request $request,$users){
        $this->validate($request,user::$change_name_rule);
        $new_name = $request -> input('change-name');
        $users -> name = $new_name;
        $users -> save();
        return $message = '表示名';
    }
    
    public function changePsid(Request $request,$users){
        $new_psid = $request -> input('change-psid');
        if($new_psid == ''){
            $users -> psid = '';
        }else{
            $this->validate($request,user::$change_psid_rule);
            $users -> psid = $new_psid;
        }
        $users ->save();
        return $message = 'PSID';
    }
    
    public function changeProfile(Request $request,$users){
        $new_profile = $request -> input('change-profile');
        if($new_profile == ''){
            $users -> profile = '';
        }else{
            $this -> validate($request,user::$change_profile_rule);
            $users -> profile = $new_profile;
        }
        $users -> save();
        $message = 'プロフィール';
        return $message;
    }
    
    public function changePassword(Request $request,$users){
        $old_password = $request -> input('old-password');
        
        if(preg_match("/^[a-zA-Z0-9]{3,16}+$/",$old_password)){
            if(Hash::check($old_password,Auth::user() -> password)){
                $this -> validate($request,user::$change_password_rule);
                // $users -> password = Hash::meke($request -> input('new-password1'));
                // $users -> save();
                $message = 'パスワード';
                return $message;
            }else{
                $message = ['password-error' => '現在のパスワードが一致しません'];
                return $message;
            }
        }else{
            $message = ['password-error' => 'パスワードは8文字以上で半角英数字と"-"、"_"が使用できます'];
            return $message;
        }
    }
}
