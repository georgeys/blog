<?php

//
Route::group(['prefix' => 'admin'], function() {
    //登录页
    Route::get('/login','Admin\LoginController@index');
    //登录逻辑
    Route::post('/login','Admin\LoginController@login');
    //登出
    Route::get('/logout','Admin\LoginController@logout');

    //添加中间键未登录不可访问
    //auth:admin为config\auth.php文件guards下定义的admin

    Route::group(['middleware' => 'auth.admin'], function(){
        //首页
        Route::get('/home','Admin\HomeController@index');
        //管理人员模块
        Route::get('users','Admin\UserController@index');
        Route::get('users/create','Admin\UserController@create');
        Route::post('users/store','Admin\UserController@store');
        //人员关联角色
        Route::get('users/{user}/role','Admin\UserController@role');
        Route::post('users/{user}/role','Admin\UserController@storeRole');

        //角色
        Route::get('roles','Admin\RoleController@index');
        Route::get('roles/create','Admin\RoleController@create');
        Route::post('roles/store','Admin\RoleController@store');
        //角色关联权限
        Route::get('roles/{role}/permission','Admin\RoleController@permission');
        Route::post('roles/{role}/permission','Admin\RoleController@storePermission');

        //权限
        Route::get('/permissions','Admin\PermissionController@index');
        Route::get('/permissions/create','Admin\PermissionController@create');
        Route::get('/permissions/store','Admin\PermissionController@store');


        //审核模块
        Route::get('posts','Admin\PostController@index');
        Route::post('posts/{post}/status','Admin\PostController@status');
    });





});