<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //后台登录页
    public function index()
    {
        return view('admin.login.index');
    }
    //登录逻辑
    public function login()
    {
        $this->validate(\request(),[
            'name'       => 'required',
            'password'    => 'required|min:5|max:10',
        ]);

        //逻辑
        $user = \request(['name','password']);
        dd($user);
        if (AdminUser::where($user)->count())
        {
            return redirect('/');
        }
        return Redirect::back()->withErrors('邮箱或密码不匹配');
    }
}
