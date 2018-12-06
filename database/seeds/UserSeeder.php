<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::create([
			'id'   => 1,
	        'name' => 'Akagami No Shanks',
	        'email' => 'akagami@email.com',
	        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
	        'remember_token' => str_random(10),
		]);

        Role::create([
            'id' => 1,
            'name' => 'admin'
        ]);

        RoleUser::create([
            'id' => 1,
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
