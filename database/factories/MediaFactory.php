<?php

use Faker\Generator as Faker;

$factory->define(App\Media::class, function (Faker $faker) {
    return [
        'rss' => $faker->unique()->url,
        'title' => $faker->text(50)
    ];
});
