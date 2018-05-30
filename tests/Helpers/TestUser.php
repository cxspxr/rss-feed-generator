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
        'password' => 'password',
        'password_confirmation' => 'password'
    ];

    public function getParams()
    {
        return $this->params;
    }

    public function create($params = [])
    {
        $media = (new TestMedia)->create();

        $user = factory(User::class)->create($params);
        $user->media()->attach($media);

        return $user;
    }
}
