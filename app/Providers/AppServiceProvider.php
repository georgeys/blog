<?php

namespace App\Providers;

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
