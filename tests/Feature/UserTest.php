<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
class UserTest extends TestCase
{
    public function test_user_creation()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }
}
