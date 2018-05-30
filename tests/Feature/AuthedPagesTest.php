<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Helpers\TestUser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthedPagesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->be((new TestUser)->create());
    }
    public function testFeedPage()
    {
        $this->get(route('feed'))->assertStatus(200);
    }

    public function testSettingsPage()
    {
        $this->get(route('account'))->assertStatus(200);
    }

    public function testSuggestionsPage()
    {
        $this->get(route('media.suggestions'))->assertStatus(200);
    }

    public function testAddMediaPage()
    {
        $this->get(route('media.add'))->assertStatus(200);
    }

    public function testLoginPage()
    {
        $this->get(route('login'))->assertRedirect(route('feed'));
    }

    public function testSignupPage()
    {
        $this->get(route('register'))->assertRedirect(route('feed'));
    }
}
