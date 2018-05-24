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
        App\Media::create([
            'rss' => 'https://sharij.net/feed',
            'title' => 'Sharij.net'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'Политика'
            ])
        );

        App\Media::create([
            'rss' => 'http://fakty.ua/rss_feed/ukraina',
            'title' => 'Fakty Ukraine'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'Украина'
            ])
        );

        App\Media::create([
            'rss' => 'http://fakty.ua/rss_feed/world',
            'title' => 'Fakty World'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'Мир'
            ])
        );

        App\Media::create([
            'rss' => 'http://fakty.ua/rss_feed/politics',
            'title' => 'Fakty Politics'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'Политика'
            ])
        );

        App\Media::create([
            'rss' => 'http://fakty.ua/rss_feed/health',
            'title' => 'Fakty Health'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'Здоровье'
            ])
        );

        App\Media::create([
            'rss' => 'http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml',
            'title' => 'NY Times'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'World News'
            ])
        );

        App\Media::create([
            'rss' => 'http://feeds.washingtonpost.com/rss/rss_election-2012',
            'title' => 'Washington Post'
        ])
        ->categories()
        ->attach(factory(App\Category::class)
            ->create([
                'title' => 'Politics'
            ])
        );
    }
}
