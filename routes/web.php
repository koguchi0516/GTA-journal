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

//ホーム画面
Route::get('/','Users\HomeController@showHome')->name('home');
Route::get('/popular/{period}','Users\HomeController@popularArticle')->name('popular_articles.');
Route::get('/favo','Users\HomeController@showHomeFavo')->name('my_favo_list');
Route::post('/user','Users\HomeController@searchUser')->name('search_user');
Route::post('/category','Users\HomeController@searchCategory')->name('search_category');
Route::get('/category/{category_id}','Users\HomeController@linkChcategory')->name('category_tag.');

//マイーページ
Route::get('/mypage/{user_id}','Users\MyPageController@showMyPage')->name('mypage.');

//フレンド募集画面
Route::get('/recrut-friend','Users\RecruitFriendController@recrutShow')->name('friend_page');
Route::post('/recrut-friend/search','Users\RecruitFriendController@friendSearch')->name('friend_search_category');

//記事詳細画
Route::get('/article/{article_title_id}','Users\ArticleTextController@showArticle')->name('show_article.');
Route::post('/article/{article_title_id}','Users\ArticleTextController@toComment')->name('post_comment.');

//報告
Route::post('/report/{article_title_id}','Admin\ReportController@report')->name('report.');

//アカウント凍結・削除
Route::post('/suspend','Admin\ReportController@suspend')->name('suspend');
Route::get('/delete-account/{user_id}','Admin\ReportController@deleteAccount')->name('delete_account.');
Route::get('/release/{user_id}','Admin\HomeController@release')->name('release.');
Route::get('/delete/{content_type}/{content_id}/','Users\ArticleTextController@deleteCoctent');

//auth
Route::group(['middleware' => 'auth'], function () {
    Route::post('/recrut-friend','Users\RecruitFriendController@recrutMessage')->name('post_friend');
    Route::get('/setting','Users\SettingController@showSettingPage')->name('setting');
    Route::post('/setting','Users\SettingController@settingHandle')->name('setting_change');
    Route::get('/favo/{article_title_id}','Users\ArticleTextController@favoArticle')->name('favo_push.');
    Route::get('/article-post','Users\ArticlePostController@showArticlePost')->name('create_article_page');
    Route::post('/article-post','Users\ArticlePostController@articlePost')->name('article_post');
    Route::get('/edit/{article_title_id}','Users\ArticlePostController@showEditArticle')->name('edit_article_page.');
    Route::get('/logout','LogoutController@logout')->name('logout');
});
    
//管理画面
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/home','Admin\HomeController@adminHome')->name('admin_page');
    Route::get('/user-list','Admin\HomeController@reportUser')->name('admin_user_list');
    Route::get('/list','Admin\HomeController@reportList')->name('admin_report_list');
});

Route::group(['prefix' => 'admin',], function () {
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin_auth.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin_auth.login');
    Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin_auth.logout');
});

Route::get('/admin/report/{report_id}','Admin\HomeController@reportDetail')->name('report_content.');

Auth::routes([
    'verify'   => false,
    'register' => true,
    'reset'    => false,
]);