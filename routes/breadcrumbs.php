<?php

// Home
Breadcrumbs::register('Home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('artist.index'));
});

// Home > Artist
Breadcrumbs::register('artist', function ($breadcrumbs, $artist) {
    $breadcrumbs->parent('Home');
    $breadcrumbs->push($artist->name, route('artist.show', $artist->name));
});

//// Home > Blog
//Breadcrumbs::register('blog', function ($breadcrumbs) {
//    $breadcrumbs->parent('home');
//    $breadcrumbs->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::register('category', function ($breadcrumbs, $category) {
//    $breadcrumbs->parent('blog');
//    $breadcrumbs->push($category->title, route('category', $category->name));
//});
//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::register('post', function ($breadcrumbs, $post) {
//    $breadcrumbs->parent('category', $post->category);
//    $breadcrumbs->push($post->title, route('post', [$post->category->name, $post->id]));
//});
