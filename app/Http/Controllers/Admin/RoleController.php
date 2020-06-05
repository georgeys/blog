<?php

namespace App\Http\Controllers\Admin;

use App\AdminPermission;
use App\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view("admin.role.index",compact('roles'));
    }
    //创建角色
    public function create()
    {
        return view("admin.role.add");
    }
    //创建行为
    public function store()
    {
        $this->validate(\request(),[
           'name' => 'required|min:3',
            'description'=>'required'
        ]);
        AdminRole::create(\request(['name','description']));

        return redirect("admin/roles");
    }
    //角色关联权限页面
    public function permission(AdminRole $role)
    {
        //获取所有权限
        $permissions = AdminPermission::all();
        //获取当前角色的权限
        $myPermissions = $role->permissions;
        return view("admin.role.permission",compact('permissions','myPermissions','role'));
    }
    //储存角色权限行为
    public function storePermission(AdminRole $role)
    {
        $this->validate(\request(),[
           'permissions' => 'required|array'
        ]);
        //上传的所有权限
        $permissions = AdminPermission::findMany(\request('permissions'));
        //我的所有权限
        $myPermissions = $role->permissions;
        //添加
        //上传的权限比我的权限多的
        $addPermissions = $permissions->diff($myPermissions);
        //执行
        foreach ($addPermissions as $permission)
        {
            $role->grantPermission($permission);
        }
        //删除
        //我本身的权限比上传多的删掉
        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission)
        {
            $role->deletePermission($permission);
        }
        return back();
    }
}
