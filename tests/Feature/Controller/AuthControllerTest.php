<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_creates_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/register', $userData);
        $response->assertStatus(200)->assertJsonStructure(['data' => ['user', 'token']]);
    }

    public function test_login_authenticates_user()
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $loginData = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);
        $response->assertStatus(200)->assertJsonStructure(['data' => ['token']]);
    }

    public function test_logout_logs_out_user()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(200)->assertJson(['message' => 'Successfully logged out']);
    }

    public function test_me_returns_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/me');
        $response->assertStatus(200)->assertJson($user->toArray());
    }
}
