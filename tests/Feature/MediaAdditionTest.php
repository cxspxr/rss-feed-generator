<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Helpers\TestUser;
use Tests\Helpers\TestMedia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaAdditionTest extends TestCase
{
    use RefreshDatabase;

    public $media;

    public function setUp()
    {
        parent::setUp();

        $this->media = new TestMedia;
        $this->be((new TestUser)->create());
    }

    public function createMedia()
    {
        return $this->post(route('media.create'),
            array_merge(
                $this->media->getParams(),
                ['categories' => 'Ukraine, Politics']
            ));
    }

    public function checkForExistingMedia()
    {
        $this->assertDatabaseHas('media', $this->media->getParams());
    }

    public function checkForNonExistingMedia()
    {
        $this->assertDatabaseMissing('media', $this->media->getParams());
    }

    public function testMediaAddition()
    {
        $this->checkForNonExistingMedia();
        $this->createMedia()->assertRedirect(route('feed'));
        $this->checkForExistingMedia();
    }
}
