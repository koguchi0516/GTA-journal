<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\AlphaNumHalf;

class SettingController extends Controller
{
    public function showSettingPage(){
        return view('users.setting');
    }
    
    public function settingHandle(Request $request){
        $input_data = $request;
        $change_value = $request->input('setting-subbmit');
        $users = User::find(Auth::user() -> id);
        
        switch($change_value){
            case 'アイコン':
                $this -> changeIcon( $request,$users );
                break;
                
            case '表示名':
                $this -> changeName( $request,$users );
                break;
                
            case 'PSID':
                $this -> changePsid( $request,$users );
                break;
                
            case 'プロフィール':
                $this -> changeProfile( $request,$users );
                break;
                
            case 'パスワード':
                $this -> changePassword( $request,$users );
                break;
        }
        return redirect('/setting');
    }
    
    public function changeIcon(Request $request,$users){
        $this -> validate($request,user::$change_icon_rule);
        $new_icon = $request -> file('newIcon');
        
        if($users -> icon !== 'default-icon.jpg'){
            \Storage::delete($users->icon);
        }
        
        // $new_icon_name = Auth::user() -> user_code. '-icon' . '.' .$new_icon -> getClientOriginalExtension();
        $target_path = 'users/' . Auth::user()->user_code;
        $new_icon_path = $new_icon -> store($target_path,['ACL' => 'public-read']);
        $users -> icon = $new_icon_path;
        $users -> save();
        $request -> Session() -> flash('info','アイコンを変更しました');
    }
    
    public function changeName(Request $request,$users){
        $this->validate($request,user::$change_name_rule);
        $new_name = $request -> input('change-name');
        $users -> name = $new_name;
        $users -> save();
        $request -> Session() -> flash('info','表示名を変更しました');
    }
    
    public function changePsid(Request $request,$users){
        $new_psid = $request -> input('change-psid');
        if($new_psid == ''){
            $users -> psid = '';
        }else{
            $request -> validate(['change-psid' => ['required','between:3,16','alpha_dash',new AlphaNumHalf]]);
            $users -> psid = $new_psid;
        }
        $users ->save();
        $request -> Session() -> flash('info','PSIDを変更しました');
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
        $request -> Session() -> flash('info','プロフィールを変更しました');
    }
    
    public function changePassword(Request $request,$users){
        $old_password = $request -> input('old-password');
        
        if(preg_match("/^[a-zA-Z0-9]{3,16}+$/",$old_password)){
            if(Hash::check($old_password,Auth::user() -> password)){
                $this -> validate($request,user::$change_password_rule);
                $new_password = $request -> input('new-password1');
                $users -> password = password_hash($new_password,PASSWORD_BCRYPT);
                $users -> save();
                $request -> Session() -> flash('info','パスワードを変更しました');
            }else{
                $request -> Session() -> flash('info','現在のパスワードが一致しません');
            }
        }else{
            $request -> Session() -> flash('info','パスワードは8文字以上で半角英数字と"-"、"_"が使用できます');
        }
    }
}
