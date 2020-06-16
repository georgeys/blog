<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        //权限中间件失败
        dd($request);
        if (!Auth::guard('admin')->user()->hasPermission('system'))
        {
            return redirect('admin/home');
        }
        return $next($request);
    }
}
