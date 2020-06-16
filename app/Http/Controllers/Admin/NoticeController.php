<?php

namespace App\Http\Controllers\admin;

use App\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    //
    public function index()
    {
        $notices  = Notice::orderBy('created_at','desc')->paginate(10);
        return view('admin.notice.index',compact('notices'));
    }
    //
    public function create()
    {
        return view('admin.notice.create');
    }
    //
    public function store()
    {
      $this->validate(\request(),[
          'title'   => 'required|string|min:2|max:50',
          'content' => 'required|string|min:1|max:9999'
      ]);
      Notice::create(\request(['title','content']));
      return redirect('admin/notices');
    }
}
