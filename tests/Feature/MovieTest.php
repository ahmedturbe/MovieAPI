<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use Tymon\JWTAuth\Facades\JWTAuth;

class MovieTest extends TestCase
{
    public function test_movie_creation()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->postJson('/api/v1/movies', [
                             'name' => 'Inception',
                             'description' => 'A mind-bending thriller',
                             'category_id' => '1',
                         ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('movies', [
            'name' => 'Inception',
            'description' => 'A mind-bending thriller',
            'category_id' => '1',
        ]);
    }
}
