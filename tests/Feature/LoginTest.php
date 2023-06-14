<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\User;
class LoginTest extends TestCase
{ 

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    //test login with correct credentials
    public function test_login_returns_token_with_valid_credentials(): void
    {  
        $user = User::factory()->create();
 
        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
 
        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token', 'success']);

    }


    //test login with incorrect credentials
    public function test_login_returns_error_with_invalid_credentials(): void
    {
        $user = User::factory()->create();
 
        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
 
        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
    }

}
