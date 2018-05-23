<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['rss', 'title'];


    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function subscribers() {
        return $this->belongsToMany(User::class);
    }
}
