<?php

namespace App\Http\Middleware;

use App\AdminUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            $adminName= $request->user()->name;
            $adminid= $request->user()->id;
            $adminpass= $request->user()->password;
            $result=AdminUser::where([["name",$adminName],["password",$adminpass]])->count();
            if ($result<=0)
            {
                return $next($request);
            }
        }
        return redirect('/admin/login');

    }
}
