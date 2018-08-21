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

//アーティスト
Route::get('/', 'IndexController@index')->name('artist.index');
Route::get('/artist/{artist}', 'IndexController@show')->name('artist.show');

//認証
Auth::routes();

//ユーザ
Route::get('/profile', 'HomeController@index')->name('profile');

//クローラ
Route::get('/movie', function() {
    $crawler = Goutte::request('GET', 'http://acidman.jp/content/liveinfo/');
    $crawler->filter('.entry-title a')->each(function ($node) {
        echo $node->text();
        echo '<br/>';
    });
    return view('welcome');
});
