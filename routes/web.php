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
Route::get('/home','Users\HomeController@showHome');
Route::get('/home/weekly','Users\HomeController@showHomeWeekly');
Route::get('/home/favo','Users\HomeController@showHomeFavo');
Route::post('/home/user','Users\HomeController@searchUser');
Route::get('/home/category/{category_id}','Users\HomeController@linkChcategory');
Route::post('/home/category','Users\HomeController@searchCategory');

/*マイーページ*/
Route::get('/mypage/{user_id}','Users\MyPageController@showMyPage');

/*フレンド募集画面*/
Route::get('/recrut-friend','Users\RecruitFriendController@recrutShow');
Route::post('/recrut-friend','Users\RecruitFriendController@recrutMessage');

/*設定画面*/
Route::get('/setting','Users\SettingController@showSettingPage')->middleware('auth');
Route::post('/setting','Users\SettingController@settingHandle')->middleware('auth');

/*記事詳細画*/
Route::get('/article/{article_title_id}','Users\ArticleTextController@showArticle');
Route::post('/article/{article_title_id}','Users\ArticleTextController@toComment');
Route::get('/favo/{article_title_id}','Users\ArticleTextController@favoArticle');

/*記事投稿・編集画面*/
Route::get('/article-post','Users\ArticlePostController@showArticlePost');
Route::post('/article-post','Users\ArticlePostController@articlePost');
Route::get('/edit/{article_title_id}','Users\ArticlePostController@showEditArticle');
 
/*報告*/
Route::post('/report/{article_title_id}','AdminController@report');

/*削除・編集*/
Route::get('/delete/{content_type}/{content_id}','Users\ArticleTextController@deleteComment');

/*ログアウト*/
Route::get('/logout','LogoutController@logout');

/*管理画面*/
// home表示・報告一覧表示・凍結中ユーザー一覧表示
Route::get('/admin/home','Admin\AdminHomeController@adminHome');
Route::get('/admin/list','Admin\AdminHomeController@reportList');
Route::get('/admin/user-list','Admin\AdminHomeController@reportUser');

// 報告記事詳細表示・報告コメント詳細表示
Route::get('/admin/report/{report_id}','Admin\AdminHomeController@reportDetail');

Auth::routes();
Route::get('/index', 'HomeController@index')->name('home');
