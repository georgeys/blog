<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view("admin.user.index",compact('users'));
    }
    //管理员创建页面
    public function create()
    {
        return view("admin.user.add");
    }
    //创建操作
    public function store()
    {
        $this->validate(\request(),[
            'name' => 'required|min:2|max:20|unique:admin_users',
            'password' => 'required|min:5|max:50'
        ]);
        $name = \request('name');
        $password = bcrypt(\request('password'));
        AdminUser::create(compact('name','password'));

        return redirect('admin/users');
    }
    //用户角色页面
    public function role()
    {
        return view("admin.user.role");
    }
    //存储用户角色
    public function storeRole()
    {

    }

}
