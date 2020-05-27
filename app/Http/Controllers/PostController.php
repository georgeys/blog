<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表页面
    public function index()
    {
        return view('post.index');
    }
    //详情页
    public function show()
    {
        return view('post.index');
    }
    //创建文章
    public function create()
    {

    }
    //创建逻辑
    public function store()
    {

    }
    //编辑页面
    public function edit()
    {

    }
    //编辑逻辑
    public function update()
    {

    }
    //删除功能
    public function delete()
    {

    }

}
