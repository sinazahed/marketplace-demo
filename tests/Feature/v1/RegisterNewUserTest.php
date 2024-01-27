<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterNewUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_api(): void
    {
        $email=fake()->unique()->safeEmail();

        $response = $this->postJson('/api/register', [
            'name' => 'Sina',
            'email' => $email,
            'password' => 'password',
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
            ],
        ]);
        
        $response->assertJson([
            'data' => [
                'name' => 'Sina',
                'email' => $email,
            ],
        ]);

        $response->assertStatus(201);

    }
}
