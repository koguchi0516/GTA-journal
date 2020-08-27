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
Route::get('/home','Users\HomeController@showHome') -> name('home');
Route::get('/home/weekly','Users\HomeController@showHomeWeekly');
Route::get('/home/favo','Users\HomeController@showHomeFavo');
Route::post('/home/user','Users\HomeController@searchUser');
Route::get('/home/category/{category_id}','Users\HomeController@linkChcategory');
Route::post('/home/category','Users\HomeController@searchCategory');

/*記事詳細画面*/

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
Route::post('/report/{article_title_id}','AdminController@report')->name('report.post');

/*削除・編集*/
Route::get('/delete/{content_type}/{content_id}','Users\ArticleTextController@deleteComment');

/*ログアウト*/
Route::get('/logout','LogoutController@logout')->name('logout');

Auth::routes();
Route::get('/index', 'HomeController@index')->name('home');
