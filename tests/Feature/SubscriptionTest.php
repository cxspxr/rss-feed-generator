<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Helpers\TestUser;
use Tests\Helpers\TestMedia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public $media;
    public $user;

    public function setUp()
    {
        parent::setUp();

        $this->media = (new TestMedia)->create();
        $this->user = (new TestUser)->create();
    }

    public function login()
    {
        $this->be($this->user);
    }

    public function subscribe()
    {
        $this->get(route('media.subscribe', $this->media->id));
    }

    public function unsubscribe()
    {
        $this->get(route('media.unsubscribe', $this->media->id));
    }

    public function checkDatabaseForExistingSubscription()
    {
        $this->assertDatabaseHas('media_user', [
            'media_id' => $this->media->id,
            'user_id' => $this->user->id
        ]);
    }

    public function checkDatabaseForNonExistingSubscription()
    {
        $this->assertDatabaseMissing('media_user', [
            'media_id' => $this->media->id,
            'user_id' => $this->user->id
        ]);
    }

    public function testAuthorizedSubscription()
    {
        $this->checkDatabaseForNonExistingSubscription();
        $this->login();
        $this->subscribe();
        $this->checkDatabaseForExistingSubscription();
    }

    public function testAuthorizedUnsubscription()
    {
        $this->login();
        $this->subscribe();
        $this->checkDatabaseForExistingSubscription();
        $this->unsubscribe();
        $this->checkDatabaseForNonExistingSubscription();
    }

    public function testUnauthorizedSubscription()
    {
        $this->subscribe();
        $this->checkDatabaseForNonExistingSubscription();
    }

}
