<?php

namespace App\Providers;

use App\AdminPermission;
use App\AdminUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //定义权限
        //所有的权限
        $permissions = AdminPermission::all();
        foreach ($permissions as $permission){
            //定义门卫（以permission的name定义）
            Gate::define($permission->name,function ($user) use($permission){
//                if ($user instanceof AdminUser) {
                    return $user->hasPermission($permission);
            });
        }
    }
}
