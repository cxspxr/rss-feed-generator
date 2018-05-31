<?php

namespace Tests\Feature;

use Tests\Helpers\TestMedia;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->get(route('home'))->assertStatus(200);
    }

    public function testLoginPage()
    {
        $this->get(route('login'))->assertStatus(200);
    }

    public function testSignupPage()
    {
        $this->get(route('register'))->assertStatus(200);
    }

    public function testMediaPage()
    {
        $this->get(route('media.index'))->assertStatus(200)
            ->assertDontSee('Subscribe')
            ->assertDontSee('Unsubscribe');
    }

    public function testReadMediaPage()
    {
        $media = (new TestMedia)->create();
        $this->get(route('media.feed', $media->id))
            ->assertSee($media->title)
            ->assertStatus(200);
    }
}
