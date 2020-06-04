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

Route::get('/', function () {
    return redirect('/posts');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/out','Auth\LoginController@logout');


//文章
Route::get('/posts','PostController@index');
//文章详情页
Route::get('/posts/{post}', 'PostController@show')->where('post','[0-9]+');
//专题详情页
Route::get('/topic/{topic}','TopicController@show')->where('post','[0-9]+');



Route::group(['middleware' => 'auth'], function() {
    //个人中心
    Route::get('/user/{user}', 'UserController@show');
    //个人设置操作
    //关注
    Route::post('/user/{user}/fan', 'UserController@fan');
    //取消关注
    Route::post('/user/{user}/unfan', 'UserController@unfan');


    //个人设置页面
    Route::get('/user/me/setting', 'UserController@setting');
    //个人设置操作
    Route::post('/user/me/setting', 'UserController@settingStore');

    //创建文章
    //route::get('/create','PostController@create');
    route::get('/posts/create', 'PostController@create');
    route::post('/posts', 'PostController@store');
    //编辑文章
    route::get('/posts/{post}/edit', 'PostController@edit');
    route::put('/posts/{post}/update', 'PostController@update');
    //删除
    route::get('/posts/{post}/delete', 'PostController@delete');
    //图片上传
    route::put('/posts/image/upload', 'PostController@imageUpload');
    //添加评论
    route::post('/posts/{post}/comment', 'PostController@comment');
    //赞
    Route::get('/posts/{post}/zan', 'PostController@zan');
    Route::get('/posts/{post}/unzan', 'PostController@unzan');

    //投稿
    Route::post('/topic/{topic}/submit', 'TopicController@submit');

});
//后台
include_once("admin.php");
