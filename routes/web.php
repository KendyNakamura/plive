<?php

// ユーザ側ルート
//認証
Auth::routes();

//アーティスト
Route::get('/', 'ArtistController@index')->name('artist.index');
Route::get('artist/{artist}', 'ArtistController@show')->name('artist.show');

// アーティスト登録
Route::post('artist/{artist}/register', 'ArtistController@register')->name('artist.register');
Route::post('artist/{artist}/register/delete', 'ArtistController@registerDelete')->name('artist.register.delete');

//ユーザ
Route::get('profile', 'HomeController@index')->name('index');

// 管理者側ルート
Route::namespace('Admin')->name('admin::')->prefix('admin')->group(function () {

    // ログイン
    Route::get('login', 'Auth\LoginController@showLogin')->name('show.login');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('logout',   'Auth\LoginController@logout')->name('logout');

    // トップ
    Route::get('/', 'HomeController@index')->name('index');

    // クローラー
    Route::get('crawler', 'CrawlerController@index')->name('crawler.index');
    Route::post('crawler', 'CrawlerController@artistStore')->name('crawler.artist.store');
    Route::post('image/upload', 'CrawlerController@imageUpload')->name('image.upload');
});
