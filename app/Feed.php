<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = "media_user";

    public function media() {
        return $this->hasMany(Media::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
