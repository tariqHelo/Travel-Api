<?php

namespace Tests\Feature;

use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class AdminTravelTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_public_user_cannot_access_adding_travel(): void
    {
        $response = $this->postJson('/api/v1/admin/travels');
 
        $response->assertStatus(401);
    }



    /**
     * A basic feature test example.
     */

     public function test_non_admin_user_cannot_access_adding_travel(): void
     {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();

        $user->roles()->attach(Role::where('name', 'Editor')->value('id'));

        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels');

        $response->assertStatus(403);
    }


    public function test_saves_travel_successfully_with_valid_data(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        
        $user->roles()->attach(Role::where('name', 'Admin')->value('id'));

        //add error data 

        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels', [
            'title' => 'test title',
            'is_published' => true,
            'description' => 'test description',
            'number_of_days' => 5,
        ]);


        $response->assertStatus(201);




    }
}
