<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use  App\Models\User;
class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('What is your name?');
        $user['email'] = $this->ask('What is your email?');
        $user['password'] = $this->secret('What is the password?');

        $roleName = $this->choice('What is your role?', ['Admin', 'Editor'], 'user');

        //check if role exists
        $role = \App\Models\Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error('Role does not exist');
            return -1 ;
        }

        //validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8'],
        ];

        //validate user data
        $validator = Validator::make($user, $rules);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return -1 ;
        }


      

        \DB::transaction(function () use ($user, $role) {
            $newUser = User::create($user + ['password' => Hash::make($user['password'])]);
            $newUser->roles()->attach($role->id);
        });

        // $newUser = \App\Models\User::create($user);
        // $newUser->roles()->attach($role->id);

        $this->info('User ' . $user['name'] . ' created');

    }
}
