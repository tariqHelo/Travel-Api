<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add roles Admin and Editor
        $roles = ['Admin', 'Editor'];

        foreach ($roles as $role) {
            \App\Models\Role::create(['name' => $role]);
        }

    }
}
