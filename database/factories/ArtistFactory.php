<?php

use Faker\Generator as Faker;

$factory->define(App\Http\Model\Artist::class, function (Faker $faker) {
    return [
            'name' => $faker->name,
            'date_selector' => str_random(10),
            'selector' => '.title',
            'url' => 'https://google.com',
            'image' => 'images/tama.jpg',
    ];
});


