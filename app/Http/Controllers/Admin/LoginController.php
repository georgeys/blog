<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    /**
     * @var string
     */
    protected $redirectTo = "/admin";

    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'logout']);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    //后台登录页
    public function index()
    {
        return view('admin.login.index');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function username()
    {
        return 'name';
    }
    //登录逻辑
//    public function login()
//    {
//        $this->validate(\request(),[
//            'name'       => 'required',
//            'password'    => 'required|min:5|max:10',
//        ]);
//
//        //逻辑
//        $user = \request(['name','password']);
//       $user= bcrypt('11111');
//        dd($user);
//        if (AdminUser::where($user)->count())
//        {
//            return redirect('/admin/home');
//        }
//        return Redirect::back()->withErrors('邮箱或密码不匹配');
//    }
}
