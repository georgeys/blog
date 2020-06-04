<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //列表页面
    public function index()
    {
//        $log = app()->make("log");
//        $log->info("post_index",['data' => 'this is log']);

        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','zans'])->paginate(5);
        return view('post.index', compact("posts"));
    }

    //详情页
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    //创建文章
    public function create()
    {
        return view('post.create');
    }

    //创建逻辑
    public function store()
    {
        //验证
        $this->validate(\request(), [
            'title' => 'required|string|max:100|min:3',
            'content' => 'required|string|min:10'
        ]);
        //luiji
        $user_id = Auth::id();
        $param = array_merge(request(['title', 'content']),compact('user_id'));
        Post::create($param);
        return redirect('/');

    }

    //编辑页面
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

//    //编辑逻辑
//    public function update(Post $post)
//    {
//        //验证
//        $this->validate(\request(),[
//            'title' => 'required|string|max:100|min:3',
//            'content' => 'required|string|min:50'
//        ]);
//        //编辑权限
//        $this->authorize('update',$post);
//        //逻辑
//        $post->title = \request('title');
//        $post->content = \request('content');
//        $post->save();
//        //渲染
//        return redirect("/posts/{$post->id}");
//    }

    //删除功能
    public function delete(Post $post)
    {
        //TODO::用户验证
        //编辑权限
        $this->authorize('delete',$post);
        $post->delete();
        return redirect("/posts");
    }

    //图片上传(没有效果)
    public function imageUpload(Request $request)
    {
        dd($request->all());
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        dd($path);
        return asset('storage/'.$path);
    }
    //提交评论
    public function comment(Post $post)
    {
        //验证
        $this->validate(\request(),[
            'content' => 'required|string|min:15|max:500'
        ]);
        //逻辑
        $user_id = Auth::id();
        $params = array_merge(
            request(['post_id', 'content']),
            compact('user_id')
        );

        Comment::create($params);
        //渲染
        return back();
    }
    //赞
    public function zan(Post $post)
    {
        $param = [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ];
        //如果有查找 没有创建
        Zan::firstOrCreate($param);
        return back();
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();
        return back();
    }


}
