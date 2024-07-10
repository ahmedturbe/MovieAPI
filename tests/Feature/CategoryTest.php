<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
class CategoryTest extends TestCase
{
    public function test_category_creation()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->postJson('/api/v1/categories', [
                             'name' => 'Action',
                             'slug' => 'Action'
                         ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            'name' => 'Action',
        ]);
    }
}
