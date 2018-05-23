<?php

namespace Tests\Helpers;

use App\Media;
use App\Category;
use Hash;

class TestMedia
{
    public $params = [
        'title' => 'sharij',
        'rss' => 'sharij.net/rss'
    ];

    public function getParams()
    {
        return $this->params;
    }

    public function create($params = [])
    {
        $tags = factory(Tag::class, 5)->create();

        $article = factory(Article::class)->create($params);
        $article->tags()->attach($tags);

        return factory(Media::class)->create($params)->categories()
            ->attach($categories);
    }
}
