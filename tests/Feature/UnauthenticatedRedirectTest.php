<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnauthenticatedRedirectTest extends TestCase
{

    public function test_profile_link()
    {
        $response = $this->get('/profile');

        $response->assertRedirect('/login');
    }

    public function test_admin_link()
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_create_post_link()
    {
        $response = $this->get('/create_post');

        $response->assertRedirect('/login');
    }
}
