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
//清理缓存

Route::get('/clear', function() { \Illuminate\Support\Facades\Artisan::call('cache:clear');return "Cache is cleared";});
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
Route::get('/posts/{post}', 'PostController@show')->where('post','[0-9]+');
//创建文章
//route::get('/create','PostController@create');
route::get('/posts/create','PostController@create');
route::post('/posts','PostController@store');
//编辑文章
route::get('/posts/{post}/edit','PostController@edit');
route::put('/posts/{post}/update','PostController@update');
//删除
route::get('/posts/{post}/delete','PostController@delete');
//图片上传
route::put('/posts/image/upload','PostController@imageUpload');
//添加评论
route::post('/posts/{post}/comment','PostController@comment');
//赞
Route::get('/posts/{post}/zan', 'PostController@zan');
Route::get('/posts/{post}/unzan', 'PostController@unzan');

//user个人主页
Route::get('/posts/{user}', 'UserController@show');
//
Route::get('/posts/me/setting', 'PostController@setting');



