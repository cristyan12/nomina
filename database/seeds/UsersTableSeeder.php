<?php

use App\{RoleUser, User};
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::create([
    		'name' => 'Cristyan Valera',
    		'email' => 'numenor21@gmail.com',
    		'password' => bcrypt('123456'),
    	]);
    	
        $role = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Usuario administador'
            'special' => 'all-access'
        ]);

        RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
    }
}
