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

    // アーティスト
    Route::get('artist', 'ArtistController@index')->name('artist.index');
    Route::get('artist/{artist}', 'ArtistController@edit')->name('artist.edit');
    Route::post('artist/{artist}', 'ArtistController@update')->name('artist.update');

    // タグ
    Route::get('tag', 'TagController@index')->name('tag.index');
    Route::get('tag/create', 'TagController@create')->name('tag.create');
    Route::post('tag/create', 'TagController@store')->name('tag.store');
    Route::get('tag/{tag}', 'TagController@edit')->name('tag.edit');
    Route::post('tag/{tag}', 'TagController@update')->name('tag.update');
});
