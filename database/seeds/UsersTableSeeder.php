<?php

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
    	App\User::create([
    		'name' => 'Cristyan Valera',
    		'email' => 'numenor21@gmail.com',
    		'password' => bcrypt('123456'),
    	]);
    	
        factory(App\User::class, 4)->create();

        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access'
        ]);
    }
}
