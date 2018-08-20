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

Route::get('/', 'IndexController@index')->name('artist.index');
Route::get('/artist/{artist}', 'IndexController@show')->name('artist.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/movie', function() {
    $crawler = Goutte::request('GET', 'http://www.uplink.co.jp/movie-show/nowshowing');
    $crawler->filter('article.post h2 a')->each(function ($node) {
        echo $node->text();
        echo '<br/>';
    });
    return view('welcome');
});
