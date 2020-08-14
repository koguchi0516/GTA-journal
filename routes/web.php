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

/*ホーム画面*/
Route::get('/home','HomeController@home');

/*記事詳細画面*/

/*マイーページ*/
Route::get('/mypage','Users\MyPageController@showMyPage')->middleware('auth');

/*フレンド募集画面*/
Route::get('/recrut-friend','Users\RecruitFriendController@recrutShow');
Route::post('/recrut-friend','Users\RecruitFriendController@recrutMessage');

/*設定画面*/
Route::get('/setting','Users\SettingController@showSettingPage')->middleware('auth');
Route::post('/setting','Users\SettingController@settingHandle')->middleware('auth');

/*管理画面*/
Route::get('/home','Users\HomeController@home');
Route::get('/article','Users\HomeController@article');
Route::get('/setting','Users\HomeController@setting');

/*記事投稿画面*/
Route::get('/article-post','Users\ArticlePostController@showArticlePost');
Route::post('/article-post','Users\ArticlePostController@articlePost');

/*報告*/
Route::post('/report','AdminController@report')->name('report.post');

/*ログアウト*/
Route::get('/logout','LogoutController@logout')->name('logout');

Auth::routes();
Route::get('/index', 'HomeController@index')->name('home');
