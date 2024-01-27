<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => 'media/'.Str::random(40).'.png',
            'product_id' => function(){
                return Product::factory()->create()->id;
            }
            ,
        ];
    }
}
