<?php

namespace Tests\Helpers;

use App\User;
use App\Feed;

use Hash;

class TestUser
{
    public $params = [
        'name' => 'test',
        'email' => 'test@gmail.com',
        'password' => Hash::make('password')
    ];

    public function getParams()
    {
        return $this->params;
    }

    public function create($params = [])
    {
        $media = new TestMedia->create();
        
        return factory(User::class)->create($params)->media()->attach($media);
    }
}
