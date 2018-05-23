<?php

namespace Tests\Helpers;

use App\Admin;
use Hash;

class TestAdmin
{
    public $params = [
        'login' => 'root',
        'password' => Hash::make('secret')
    ];

    public function getParams()
    {
        return $this->params;
    }

    public function create($params = [])
    {
        return factory(Admin::class)->create($params);
    }
}
