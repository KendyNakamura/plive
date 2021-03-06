<?php

// User route
// Auth
Auth::routes();

// artist
Route::get('/', 'ArtistController@index')->name('artist.index');
Route::get('artist/{artist}', 'ArtistController@show')->name('artist.show');

// Register artist
Route::post('artist/{artist}/register', 'ArtistController@register')->name('artist.register');
Route::post('artist/{artist}/register/delete', 'ArtistController@registerDelete')->name('artist.register.delete');

// User
Route::get('profile', 'HomeController@index')->name('index');

// message
Route::post('message/store/{artist}', 'MessageController@store')->name('message.store');

// Admin route
Route::namespace('Admin')->name('admin::')->prefix('admin')->group(function () {

    // Login
    Route::get('login', 'Auth\LoginController@showLogin')->name('show.login');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('logout',   'Auth\LoginController@logout')->name('logout');

    // Top
    Route::get('/', 'HomeController@index')->name('index');

    // Artist
    Route::get('artist', 'ArtistController@index')->name('artist.index');
    Route::get('artist/create', 'ArtistController@create')->name('artist.create');
    Route::post('artist/store', 'ArtistController@store')->name('artist.store');
    Route::get('artist/{artist}', 'ArtistController@edit')->name('artist.edit');
    Route::post('artist/{artist}/update', 'ArtistController@update')->name('artist.update');
    Route::post('artist/{artist}/delete', 'ArtistController@delete')->name('artist.delete');

    // Live
    Route::post('live/{live}', 'ArtistController@liveUpdate')->name('live.update');
    Route::post('live/update/{artist}', 'ArtistController@livesUpdate')->name('lives.update');
    Route::post('live/delete/{live}', 'ArtistController@liveDelete')->name('live.delete');

    // Place
    Route::get('place', 'PlaceController@index')->name('place.index');
    Route::get('place/create', 'PlaceController@create')->name('place.create');
    Route::post('place/store', 'PlaceController@store')->name('place.store');
    Route::get('place/{place}', 'PlaceController@edit')->name('place.edit');
    Route::post('place/{place}/update', 'PlaceController@update')->name('place.update');
    Route::post('place/{place}/delete', 'PlaceController@delete')->name('place.delete');

    // Tag
    Route::get('tag', 'TagController@index')->name('tag.index');
    Route::get('tag/create', 'TagController@create')->name('tag.create');
    Route::post('tag/store', 'TagController@store')->name('tag.store');
    Route::get('tag/{tag}', 'TagController@edit')->name('tag.edit');
    Route::post('tag/{tag}/update', 'TagController@update')->name('tag.update');
    Route::post('tag/{tag}/delete', 'TagController@delete')->name('tag.delete');
});
