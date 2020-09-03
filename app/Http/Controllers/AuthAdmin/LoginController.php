<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function username(){
        return 'name';
    }
    
    // ここまで、以下追加
    
    public function showLoginForm(){
    return view('admin.login'); //ログインページ
    }
    
    protected function guard(){
    return Auth::guard('admin'); //管理者用のguardに変更
    }
    
    public function logout(Request $request){
    $this->guard()->logout();
    return redirect('/admin/login'); //ログアウト後の遷移先
    }
}
