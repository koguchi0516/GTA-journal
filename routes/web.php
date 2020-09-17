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

//ホーム画面
Route::group(['prefix' => 'home'], function() {
    Route::get('/','Users\HomeController@showHome');
    Route::get('/weekly','Users\HomeController@showHomeWeekly');
    Route::get('/favo','Users\HomeController@showHomeFavo');
    Route::post('/user','Users\HomeController@searchUser');
    Route::get('/category/{category_id}','Users\HomeController@linkChcategory');
    Route::post('/category','Users\HomeController@searchCategory');
});

//マイーページ
Route::get('/mypage/{user_id}','Users\MyPageController@showMyPage');

//フレンド募集画面
Route::get('/recrut-friend','Users\RecruitFriendController@recrutShow');
Route::post('/recrut-friend','Users\RecruitFriendController@recrutMessage');

//設定画面
Route::get('/setting','Users\SettingController@showSettingPage')->middleware('auth');
Route::post('/setting','Users\SettingController@settingHandle')->middleware('auth');

//記事詳細画
Route::get('/article/{article_title_id}','Users\ArticleTextController@showArticle');
Route::post('/article/{article_title_id}','Users\ArticleTextController@toComment');
Route::get('/favo/{article_title_id}','Users\ArticleTextController@favoArticle');

//記事投稿・編集画面
Route::get('/article-post','Users\ArticlePostController@showArticlePost');
Route::post('/article-post','Users\ArticlePostController@articlePost');
Route::get('/edit/{article_title_id}','Users\ArticlePostController@showEditArticle');
 
//報告
Route::post('/report/{article_title_id}','Admin\ReportController@report');

//投稿削除・編集
Route::get('/delete/{content_type}/{content_id}','Users\ArticleTextController@deleteComment');

//ログアウト
Route::get('/logout','LogoutController@logout');

//アカウント凍結・削除
Route::post('/suspend','Admin\ReportController@suspend');
Route::get('/deleteAccount/{user_id}','Admin\ReportController@deleteAccount');
Route::get('/release/{user_id}','Admin\HomeController@release');

//管理画面
// home表示・報告一覧表示・凍結中ユーザー一覧表示
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
Route::get('/home','Admin\HomeController@adminHome');
Route::get('/list','Admin\HomeController@reportList');
Route::get('/user-list','Admin\HomeController@reportUser');
});

//管理者用認証
Route::group(['prefix' => 'admin',], function () {
Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin_auth.login');
Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin_auth.login');
Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin_auth.logout');
});

//報告記事詳細表示・報告コメント詳細表示
Route::get('/admin/report/{report_id}','Admin\HomeController@reportDetail');

Auth::routes();
Route::get('/index', 'HomeController@index')->name('home');