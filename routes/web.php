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

// ルートをログイン画面に設定
Route::get('/', function(){return redirect('login');});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('confirm', 'Auth\RegisterController@confirmForm')->name('confirm');
Route::post('confirm', 'Auth\RegisterController@confirm');
Route::get('complete', function(){
    return view('auth.complete');
});

// Thread Routers...
Route::get('home', 'Thread\HomeController@index')->name('home');
Route::post('home', 'Thread\HomeController@postIndex');
Route::get('home/create', 'Thread\HomeController@threadCreateForm')->name('threadCreate');
Route::post('home/create', 'Thread\HomeController@threadCreate')->name('threadCreate');
Route::get('home/thread/{thread_id}', 'Thread\HomeController@thread')->name('thread');
Route::get('home/thread/{thread_id}/delete', 'Thread\HomeController@threadDeleteForm')->name('threadDelete');
Route::post('home/thread/{thread_id}/delete', 'Thread\HomeController@threadDelete')->name('threadDelete');

// Comment Routers...
Route::post('home/thread/{thread_id}/post', 'Thread\CommentController@post')->name('post');
Route::get('home/thread/{thread_id}/comment/{comment_id}/fix', 'Thread\CommentController@commentFixForm')->name('commentFix');
Route::post('home/thread/{thread_id}/comment/{comment_id}/fix', 'Thread\CommentController@commentFix')->name('commentFix');
Route::get('home/thread/{thread_id}/comment/{comment_id}/delete', 'Thread\CommentController@commentDeleteForm')->name('commentDelete');
Route::post('home/thread/{thread_id}/comment/{comment_id}/delete', 'Thread\CommentController@commentDelete')->name('commentDelete');
