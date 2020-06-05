<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //权限列表
    public function index()
    {
        return view("admin.permission.index");
    }
    //创建权限
    public function create()
    {
        return view("admin.permission.add");
    }
    //创建行为
    public function store()
    {

    }
}
