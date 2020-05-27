<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//注册页面
Route::get('/','RegisterController@index');
//注册行为
Route::post('/', 'RegisterController@register');

//登录页面
Route::get('/login', 'LoginController@index');
//登录行为
Route::post('/login', 'LoginController@login');
//登出行为
Route::get('/logout', 'LoginController@logout');

//个人设置页面
Route::get('/user/me/setting', 'UserController@setting');
//个人设置操作
Route::post('/user/me/setting', 'UserController@settingStore');

//文章
Route::get('/posts','PostController@index');
//文章详情页
Route::get('/posts/{post}', 'PostController@show');
//创建文章
route::get('/create','PostController@create');
route::post('/posts','PostController@store');
//编辑文章
route::get('/posts/{post}/edit','PostController@edit');
route::put('/posts/{post}/update','PostController@update');
//删除
route::get('/posts/delete','PostController@delete');

