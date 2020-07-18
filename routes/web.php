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
    return view('welcome');
});

    Route::get('home','Users\HomeController@home');
    Route::get('mypage','Users\HomeController@myPage')->middleware('auth');
    Route::get('article-post','Users\HomeController@articlePost');
    Route::get('article','Users\HomeController@article');
    Route::get('recrute-friend','Users\HomeController@recruteFriend');
    Route::get('setting','Users\HomeController@setting');
Auth::routes();

// 必要なの確認
// Route::get('/home', 'HomeController@index')->name('home');
