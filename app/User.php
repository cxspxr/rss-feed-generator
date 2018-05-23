<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function media() {
        return $this->belongsToMany(Media::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function read($tags) {
        $categories = explode(",", $tags);

        foreach ($categories as $category) {
            $tag = Tag::firstOrCreate([
                'title' => $category
            ]);

            $existingRelationTag = $this->tags()->where('tags.id', $tag->id)->first();
            if ($existingRelationTag) {
                $this->tags()->updateExistingPivot($tag->id, [
                    'times' => $existingRelationTag->pivot->times + 1
                ]);
            } else {
                $this->tags()->attach($tag);
            }
        }
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('times');
    }

    public function interests()
    {
        return $this->tags()->orderBy('tag_user.times', 'desc')->take(10)->get();
    }

    public function subscribe(Media $media)
    {
        return $this->media()->sync($media, false);
    }

    public function unsubscribe(Media $media)
    {
        return $this->media()->detach($media);
    }

    public function subscribedTo(Media $media) {
        return $this->media->contains($media);
    }
}
