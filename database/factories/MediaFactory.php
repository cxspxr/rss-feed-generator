<?php

use Faker\Generator as Faker;

$factory->define(App\Media::class, function (Faker $faker) {
    return [
        'rss' => $faker->text(50),
        'title' => $faker->title
    ];
});
