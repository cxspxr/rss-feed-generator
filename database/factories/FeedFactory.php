<?php

use Faker\Generator as Faker;

$factory->define(App\Feed::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'media_id' => factory(App\Media::class)->create()->id
    ];
});
