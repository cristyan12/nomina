<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
	use RefreshDatabase;

	/**
     * @testdox Se puede cargar la página de registro de usuarios
     * @test 
     */
    function it_can_load_the_register_user_page()
    {
        $response = $this->get('register')
        	->assertOk()
        	->assertViewIs('auth.register')
        	->assertSee('Registrar');
    }

    /**
     * @testdox Un usuario anonimo se puede registrar en el sistema
     * @test 
     */
    function a_anonimus_user_can_register()
    {
        $response = $this->post(route('register', [
        	'name' => 'Cristyan Valera',
        	'email' => 'numenor21@gmail.com',
        	'password' => '123456',
            'password_confirmation' => '123456',
        ]))
        ->assertRedirect('/home');

        $user = \App\User::first();

        $this->assertSame('Cristyan Valera', $user->name);
        $this->assertSame('numenor21@gmail.com', $user->email);
    }
}
