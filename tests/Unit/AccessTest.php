<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccessTest extends TestCase
{
    public function testGuestCanNotAccessDashboard()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testGuestCanNotAccessLanguages()
    {
        $response = $this->get('/language');

        $response->assertStatus(302);
    }

    public function testGuestCanNotAccessWebsites()
    {
        $response = $this->get('/website');

        $response->assertStatus(302);
    }

    public function testGuestCanNotSyncEntries()
    {
        $response = $this->get('/entry/sync');

        $response->assertStatus(302);
    }

    public function testLoggedUserCanAccessDashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function testLoggedUserCanAccessLanguages()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/language');

        $response->assertStatus(200);
    }

    public function testLoggedUserCanAccessWebsites()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/website');

        $response->assertStatus(200);
    }

    public function testLoggedUserWithUserRoleCanNotAccessUsers()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get('/user');

        $response->assertStatus(403);
    }

    public function testLoggedUserWithAdminRoleCanAccessUsers()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get('/user');

        $response->assertStatus(200);
    }
}
