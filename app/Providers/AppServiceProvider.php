<?php

namespace App\Providers;

use App\AdminUser;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Symfony\Component\CssSelector\Parser\Handler\IdentifierHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //设置默认string长度
        Schema::defaultStringLength(191);
//视图合成器  直接向视图siderbar传输数据
        view()->composer("layouts.sidebar",function ($view){
            $toptic = Topic::all();
            $view->with('topics',$toptic);
        });
        view()->composer("admin.layout.sidebar",function ($view){
            $permissions = array();
            $roles = Auth::guard("admin")->user()->roles;
            foreach ($roles as $role)
            {
                foreach ($role->permissions as $permission)
                {
                    $permissions[] = $permission->name;
                }
            }
            $view->with('permissions',$permissions);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {

        }
        // ...
    }
}
