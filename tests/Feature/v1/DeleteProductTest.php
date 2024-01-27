<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_product(): void
    {
        // Assuming you have a product in the database with ID 1

        $product=Product::factory()->create();

        $user = User::find($product->user_id);

        $token=$user->createToken('test-token')->plainTextToken;
        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/v1/product/delete/' . $product->id);
    
        $response->assertStatus(200);
        $response->assertJson(['data'=>['message' => 'Product deleted successfully']]);
    
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_insure_each_user_can_delete_own_product(): void
    {
        $product=Product::factory()->count(2)->create();
        
        $user = User::find($product[1]->user_id);

        $token=$user->createToken('test-token')->plainTextToken;
        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/v1/product/delete/' . $product[0]->id);
    
        $response->assertStatus(403);
    }
}
