<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    public function show(Topic $topic)
    {
        //带有文章数量的专题
//        $topics = Topic::find($topic->id);

        //专题文章的列表按照倒序5个
        $posts = $topic->posts()->orderBy('created_at','desc')->paginate(5);
        //没有投稿的但是属于我的文章
//        $p= new Post();
        $myposts = Post::authorBy(Auth::id())->topicNotBy($topic->id)->paginate(10);

        return view('topic.show',compact('topic','posts','myposts'));
    }
    //投稿
    public function submit(Topic $topic)
    {
        $this->validate(\request(),[
            'post_ids' => 'required|array'
        ]);
        $post_ids = \request('post_ids');
        $topic_id = $topic->id;
        //查询没有则创建有的话返回
        foreach ($post_ids as $post_id)
        {
            PostTopic::firstOrCreate(compact('post_id','topic_id'));
        }
    }
}
