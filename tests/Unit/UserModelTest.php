<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    function can_create_users()
    {
    	$user = User::make([
    		'name' => 'Cristyan Valera',
    		'email' => 'numenor@mail.com',
    		'password' => bcrypt('1234560')
    	]);

    	$this->assertSame('Cristyan Valera', $user->name);
    	$this->assertSame('numenor@mail.com', $user->email);
    }

    /** @test */
    function can_edit_users()
    {
    	$user = User::make([
    		'name' => 'Cristyan Valera',
    		'email' => 'otrocorreo@mail.com',
    		'password' => bcrypt('1234560')
    	]);

    	$user = User::find(1);
    	$user->email = 'numenor@gmail.com';
    	$user->save();

    	$this->assertSame('Cristyan Valera', $user->name);
    	$this->assertSame('numenor@gmail.com', $user->email);
    }
}
