<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Helpers\TestUser;
use Tests\Helpers\TestMedia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaSearchTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    public $media;

    public function setUp()
    {
        parent::setUp();


        $this->media = (new TestMedia)->create();
    }

    public function testSearchByTitle()
    {
        $this->get(route('search'), [
            'q' => substr($this->media->title, 2)
        ])
        ->assertStatus(200)
        ->assertSee($this->media->title);
    }

    public function testSearchByCategory()
    {
        $this->get(route('search'), [
            'q' => substr($this->media->categories[0]->title, 2)
        ])
        ->assertStatus(200)
        ->assertSee($this->media->title);
    }

    public function testSearchForAllMedia()
    {
        $this->get(route('search'), [
            'q' => ''
        ])
        ->assertStatus(200)
        ->assertSee($this->media->title);
    }
}
