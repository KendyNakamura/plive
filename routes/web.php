<?php

// ユーザ側ルート
//アーティスト
    Route::get('/', 'ArtistController@index')->name('artist.index');
    Route::get('artist/{artist}', 'ArtistController@show')->name('artist.show');

    //認証
    Auth::routes();

    Route::group(['middleware' => 'auth:user'], function() {
        // アーティスト登録
        Route::post('artist/{artist}/register', 'ArtistController@register')->name('artist.register');
        Route::post('artist/{artist}/register/delete', 'ArtistController@registerDelete')->name('artist.register.delete');

        //ユーザ
        Route::get('profile', 'HomeController@index')->name('profile');
    });

// 管理者側ルート
Route::namespace('Admin')->name('admin::')->prefix('admin')->group(function () {

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::post('Auth\logout',   'LoginController@logout')->name('logout');
        Route::get('crowler', 'HomeController@crowlerIndex')->name('crowler.index');
    });
});
