<?php

use Faker\Generator as Faker;

$factory->define(App\Http\Model\Live::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'artist_id' => 1,
    ];
});
