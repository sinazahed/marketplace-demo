<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_products(): void
    {
        $product=Product::factory()->count(3)->create();
        $user = User::factory()->create();
        $token=$user->createToken('test-token')->plainTextToken;

        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)->get('/api/v1/product/explore');
        $response->assertJsonStructure([
            'data' => [
                '*' =>['id', 'title', 'price', 'shipping_price','medias'],
            ],
        ]);
        $response->assertStatus(200);
    }

    public function test_show_products_title_filter(): void
    {
        
        $product=Product::create([
            'title'=>'this is test title for search',
            'price'=>10000,
            'shipping_price'=>0,
            'user_id'=>User::factory()->create()->id
        ]);
        $user = User::factory()->create();
        $token=$user->createToken('test-token')->plainTextToken;

        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)->get('/api/v1/product/explore?title=this is test title for search');
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id','title','price','shipping_price','price_with_shipping','medias' => [],
                ],
            ],
            'links',
            'meta',
            'status',
        ]);

        $response->assertStatus(200);
    }

}
