<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Travel;
class AdminTourTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
        */

    public function test_public_user_cannot_access_adding_tour(): void
    { 
        $travel = Travel::factory()->create();
        $response = $this->postJson('/api/v1/admin/travels/'.$travel->id.'/tours');

        $response->assertStatus(401);
    }


    public function test_non_admin_can_not_access_adding_tour(): void
    {   
        $travel = Travel::factory()->create();

        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();

        $user->roles()->attach(Role::where('name', 'Editor')->value('id'));

        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels/'.$travel->id.'/tours');

        $response->assertStatus(403);

    }


    public function test_saves_tour_with_valid_data():void 
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();

        $user->roles()->attach(Role::where('name', 'Admin')->value('id'));

        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels/'.$travel->id.'/tours', [
            'name' => 'test name',
        ]);
        //return error if data is not valid
        $response->assertStatus(422);



        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels/'.$travel->id.'/tours', [
            'name' => 'test name',
            'travel_id' => $travel->id,
            'price' => 100,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
       ]);



       $response->assertStatus(201);


       $response = $this->get('/api/v1/travels/'.$travel->id.'/tours');

       $response->assertJsonFragment([
           'name' => 'test name'
       ]);
    }
}
