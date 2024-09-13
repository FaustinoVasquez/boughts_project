<?php

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'url' => $faker->str_random(60),
    ];
});
