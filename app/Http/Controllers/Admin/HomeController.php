<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //首页
    public function index()
    {
        dd(Auth::guard("admin")->user()->roles);
        return view('admin.home.index');
    }
}
