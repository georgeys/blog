<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //登录页面
    public function index()
    {
        return view('login.index');

    }
    //登录行为
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'       => 'required|email',
            'password'    => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);

        //逻辑
        $user = \request(['email','password']);
        $is_remember = boolval(\request('is_remember'));
        if (Auth::attempt($user,$is_remember))
        {
            return redirect('/');
        }
        return Redirect::back()->withErrors('邮箱或密码不匹配');


    }
    //登出行为
    public function logout()
    {
        Auth::logout();
        return \redirect('/login');
    }
}
