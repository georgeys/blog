<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    //
    public function index()
    {
        $topics = Topic::orderBy('created_at','desc')->paginate(10);
        return view("admin.topic.index",compact('topics'));
    }
    //
    public function create()
    {
        return view("admin.topic.create");
    }
    //
    public function store()
    {
        $this->validate(\request(),[
            'name'=>'required|string|max:10|min:1'
        ]);
        Topic::create(['name'=>\request('name')]);
        return redirect("admin/topics");
    }
    //
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return[
            'error' => '0',
            'msg'  => ''
        ];
    }



}
