<?php

namespace Database\Seeders;

use App\Models\User;
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
    	$user = User::create([
    		'name' => 'Cristyan Valera',
    		'email' => 'numenor21@gmail.com',
    		'password' => bcrypt('123456'),
    	]);
    }
}
