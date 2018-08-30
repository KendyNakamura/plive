<?php

use Faker\Generator as Faker;

$factory->define(App\Http\Model\Artist::class, function (Faker $faker) {
    return [
            'name' => $faker->name,
            'selector' => '.title',
            'title_selector' => '.title',
            'date_selector' => '.date',
            'url' => 'https://google.com',
            'image' => 'images/tama.jpg',
    ];
});


