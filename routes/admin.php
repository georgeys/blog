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
    });





});