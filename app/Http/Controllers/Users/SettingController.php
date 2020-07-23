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
    
    public function settingHandle(){
        $change_item = Input::get();
        switch($change_item){
            case 'icon':
                $htis->changeIcon();
                break;
            case 'name':
                $this->changeName();
        }
    }
    public function changeName(){
            $data='成功';
            return view('users.setting',$data);
        }
}
