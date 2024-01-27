<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadMediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_upload(): void
    {

        $product=Product::factory()->create();

        $user = User::find($product->user_id);

        $token=$user->createToken('test-token')->plainTextToken;

        Storage::fake('public');
        $file = UploadedFile::fake()->image('test_image.png');

        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/v1/upload/media', [
            'product_id' => $product->id,
            'media' => $file,
        ]);


        $response->assertJsonStructure([
            'data' => [
                'id',
                'location',
                'product_id',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'product_id' =>$product->id,
            ],
        ]);

        $response->assertStatus(201);
    }
}
