<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::withoutGlobalScope('avaiable')->orderBy('created_at','desc')->where('status','0')->paginate(10);
        return view("admin.post.index",compact('posts'));
    }
    //审核文章
    public function status(Post $post)
    {
        $this->validate(\request(),[
            'status' => 'required|in:-1,1'
        ]);
        $post->status =\request('status');
        $post->save();
        return[
          'error' =>0,
          'msg'   =>''
        ];
    }
    //文章详情页面
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }
    //审核文章
    public function showStatus(Post $post)
    {
        $this->validate(\request(),[
            'status' => 'required|in:-1,1'
        ]);
        $post->status =\request('status');
        $post->save();

        return redirect('admin/posts');
    }
}
