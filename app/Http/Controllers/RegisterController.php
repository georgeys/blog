<?php

namespace App\Http\Controllers;

use App\Home\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
        return view('register.index');
    }
    //注册行为
    public function register(Request $request)
    {
        //验证
        $this->validate($request,[
            'name'      => 'required|min:3|max:20|unique:user',
            'email'     => 'required|unique:user|email',
            'password'  => 'required|confirmed|min:6|max:20 '
        ]);//注册
       $data = $request->all();
       $data['password'] = bcrypt($data['password']);
       $result = \App\User::create($data);
        //返回登录页面
        return redirect('/login');
//
    }
}
