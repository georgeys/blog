<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        return view("admin.role.index");
    }
    //创建角色
    public function create()
    {
        return view("admin.role.add");
    }
    //创建行为
    public function store()
    {

    }
    //角色关联权限页面
    public function permission()
    {
        return view("admin.role.permission");
    }
    //
    public function storePermission()
    {

    }
}
