<?php

use Faker\Generator as Faker;

$factory->define(App\Media::class, function (Faker $faker) {
    return [
        'rss' => 'http://feeds.bbci.co.uk/news/technology/rss.xml',
        'title' => $faker->text(50)
    ];
});
