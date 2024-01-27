<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Event;

class CreateOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order_with_shipping(): void
    {
        Event::fake();

        $product=Product::factory()->create();
        $user = User::factory()->create();
        $token=$user->createToken('test-token')->plainTextToken;

        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson('/api/v1/order/create',[
                'product_id' =>[$product->id] ,
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'total_price'
            ],
        ]);

        $response->assertJson([
            'data' => [
                'total_price' =>number_format($product->price),
            ],
        ]);

    }
}
