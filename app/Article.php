<?php

namespace App;

use Hash;
use Carbon\Carbon;

class Article
{
    public $title;
    public $description;
    public $date;
    public $link;
    public $tags;
    public $id;

    public function __construct($data) {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->date = $data['date'];
        $this->link = $data['link'];
        if(isset($data['tags'])) {
            $this->tags = join(",", $data['tags']);
        }
    }

    public static function create($article) {
        $array = $article->data['child'][''];

        $data['title'] = $array['title'][0]['data'];
        $data['description'] = $array['description'][0]['data'];
        $data['date'] = $array['pubDate'][0]['data'];
        $data['link'] = $array['link'][0]['data'];
        if(isset($array['category'])) {
            $data['tags'] = array_column($array['category'], 'data');
        }

        return new Article($data);
    }

}
