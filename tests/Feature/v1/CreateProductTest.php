<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateProductTest extends TestCase
{

    use RefreshDatabase;

    public function test_create_product_api(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/v1/product/create',[
            'title' => 'ok',
            'price' =>1,
            'shipping_price' =>2,
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'price',
                'shipping_price',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'title' => 'ok',
                'price' =>1,
                'shipping_price' =>2,
            ],
        ]);

        $response->assertStatus(201);

    }
}
