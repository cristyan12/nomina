<?php

use Illuminate\Database\Seeder;

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
    		'email' => 'numenor@gmail.com',
    		'password' => bcrypt('123456'),
    	]);
    	
        factory(App\User::class, 4)->create();
    }
}
