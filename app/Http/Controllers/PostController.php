<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //列表页面
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('post.index',compact("posts"));
    }
    //详情页
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }
    //创建文章
    public function create()
    {
        return view('post.create');
    }
    //创建逻辑
    public function store()
    {
        Post::create(request(['title','content','user_id']));
    }
    //编辑页面
    public function edit()
    {
        return view('post.edit');
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
