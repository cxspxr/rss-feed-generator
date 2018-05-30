<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnauthedPagesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSettingsPage()
    {
        $this->get(route('account'))->assertRedirect(route('login'));
    }

    public function testAddMediaPage()
    {
        $this->get(route('media.add'))->assertRedirect(route('login'));
    }

    public function testSuggestionsPage()
    {
        $this->get(route('media.suggestions'))->assertRedirect(route('login'));
    }

    public function testFeedPage()
    {
        $this->get(route('feed'))->assertRedirect(route('login'));
    }
}
