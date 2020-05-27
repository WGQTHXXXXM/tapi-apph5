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
    return view('notfound');
});

Route::get('app-h5/about','InfoController@about')->name('info.about.haspath'); //关于奇点
Route::get('about','InfoController@about')->name('info.about'); //关于奇点

Route::get('app-h5/info/privacypolicies','InfoController@privacyPolicies')->name('info.privacypolicies.haspath'); //关于奇点
Route::get('info/privacypolicies','InfoController@privacyPolicies')->name('info.privacypolicies'); //关于奇点

Route::get('app-h5/info/agreements','InfoController@agreements')->name('info.agreements.haspath'); //关于奇点
Route::get('info/agreements','InfoController@agreements')->name('info.agreements'); //关于奇点


Route::get('app-h5/detail/{id}','NewsController@detail')->name('news.detail.haspath')->where(['id'=>'[a-z0-9]{32}']); //文章详情
Route::get('detail/{id}','NewsController@detail')->name('news.detail')->where(['id'=>'[a-z0-9]{32}']); //文章详情
Route::get('app-h5/articles/{id}','NewsController@article')->name('news.article.haspath')->where(['id'=>'[a-z0-9]{32}']); //文章详情article版本
Route::get('articles/{id}','NewsController@article')->name('news.article')->where(['id'=>'[a-z0-9]{32}']); //文章详情article版本

Route::get('app-h5/articles/{id}/video','NewsController@video')->name('news.video.haspath')->where(['id'=>'[a-z0-9]{32}']); //视频文章详情
Route::get('articles/{id}/video','NewsController@video')->name('news.video')->where(['id'=>'[a-z0-9]{32}']); //视频文章详情

Route::get('app-h5/scorerule', 'MallController@scorerule')->name('mall.scorerule.haspath'); // 积分规则
Route::get('scorerule', 'MallController@scorerule')->name('mall.scorerule');    // 积分规则

Route::get('app-h5/returnback', 'MallController@returnback')->name('mall.returnback.haspath');  // 退换货说明
Route::get('returnback', 'MallController@returnback')->name('mall.returnback'); // 退换货说明


Route::get('app-h5/fulltext', 'FulltextController@show')->name('fulltext.show.haspath');    // 富文本字段
Route::get('fulltext', 'FulltextController@show')->name('fulltext.show');   // 富文本字段


Route::get('app-h5/notfound', function () {
    return view('notfound');
}); //未找到时候的页面
Route::get('notfound', function () {
    return view('notfound');
}); //未找到时候的页面

