<?php

use Faker\Generator as Faker;

$factory->define(App\Http\Model\Artist::class, function (Faker $faker) {
    return [
            'name' => $faker->name,
            'content' => str_random(10),
            'selector' => '.title',
            'url' => 'https://google.com', // secret
            'image' => 'images/tama.jpg',
    ];
});


