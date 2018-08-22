<?php

//アーティスト
Route::get('/', 'ArtistController@index')->name('artist.index');
Route::get('/artist/{artist}', 'ArtistController@show')->name('artist.show');

// アーティスト登録
Route::post('/artist/{artist}/register', 'ArtistController@register')->name('artist.register');

//認証
Auth::routes();

//ユーザ
Route::get('/profile', 'HomeController@index')->name('profile');

//クローラ
Route::get('/movie', function() {
    $crawler = Goutte::request('GET', 'https://10-feet.kyoto/contents/live');
    $crawler->filter('.time')->each(function ($node) {
        echo $node->text();
        echo '<br/>';
    });
    return view('welcome');
});
