<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Helpers\TestUser;

class SignupTest extends TestCase
{
    use RefreshDatabase;

    public function getUser()
    {
        return new TestUser();
    }

    public function testSignUp()
    {
        $this->post(route('register'), $this->getUser()->getParams())
            ->assertRedirect(route('feed'));

        $this->assertDatabaseHas('users', [
            'name' => $this->getUser()->getParams()['name'],
            'email' => $this->getUser()->getParams()['email']
        ]);

        $this->post(route('logout'));
    }

    public function testLogin()
    {
        $this->testSignUp();
        $this->post(route('login'), $this->getUser()->getParams())
            ->assertRedirect(route('feed'));
    }
}
