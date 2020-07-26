<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\User;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function showSettingPage(){
        return view('users.setting');
    }
    
    public function settingHandle(Request $request){
        $change_value = $request->input('setting-subbmit');
        $users = User::find(Auth::user()->id);
        
        switch($change_value){
            case 'アイコン変更':
                $message = 'アイコン';
                break;
                
            case '表示名変更':
                $this->validate($request,['change-name'=>'required']);
                $new_name = $request->input('change-name');
                $users -> name = $new_name;
                $users -> save();
                $message = '表示名';
                break;
                
            case 'PSID変更':
                $new_psid = $request->input('change-psid');
                if($new_psid == ''){
                    $users -> psid = '';
                }else{
                    $this->validate($request,['change-psid'=>'max:20|alpha_dash']);
                    $users -> psid = $new_psid;
                }
                $users ->save();
                $message = 'PSID';
                break;
                
            case 'プロフィール変更':
                $new_profile = $request -> input('change-profile');
                if($new_profile == ''){
                    $users -> profile = '';
                }else{
                    $this -> validate($request,['change-profile'=>'max:255']);
                    $users -> profile = $new_profile;
                }
                $users -> save();
                $message = 'プロフィール';
                break;
                
            case 'パスワード変更':
                $request->input('password');
                break;
        }
        return view('users.setting',compact('message'));
        // return redirect('/setting'); 変更内容が随時反映されるが$messageを渡せない
        
    }
}
