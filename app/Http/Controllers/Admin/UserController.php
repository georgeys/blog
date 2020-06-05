<?php

namespace App\Http\Controllers\Admin;

use App\AdminRole;
use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

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
    public function role(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;

        return view("admin.user.role",compact('user','roles','myRoles'));
    }
    //存储用户角色
    public function storeRole(AdminUser $user)
    {
        $this->validate(\request(),[
            'roles' => 'required|array'
        ]);
        //查询上传过来的所有角色
        $roles = AdminRole::findMany(\request('roles'));
        //这个用户的所有角色
        $myRoles = $user->roles;
        //添加
        //上传角色比我多的角色
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role)
        {
            $user->assignRole($role);
        }
        //删除
        //我的角色比上传多的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role)
        {
            $user->deleteRole($role);
        }
        return back();

    }

}
