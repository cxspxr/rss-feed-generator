<?php

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Media::class)->create([
            'rss' => 'https://sharij.net/feed',
            'title' => 'Sharij.net'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
        ->create([
            'title' => 'Политика'
        ]));

        factory(App\Media::class)->create([
            'rss' => 'http://fakty.ua/rss_feed/ukraina',
            'title' => 'Fakty'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
        ->create([
            'title' => 'Украина'
        ]));


        factory(App\Media::class, 2)->create()->each(function ($media) {
            $media->categories()->attach(factory(App\Category::class, 5)->create());
        });
    }
}
