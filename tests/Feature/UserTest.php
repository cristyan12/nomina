<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

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

        $user = User::first();

        $this->assertSame('Cristyan Valera', $user->name);
        $this->assertSame('numenor21@gmail.com', $user->email);
    }

    /**
     * @testdox Un administrador puede crear un usuario
     * @test
     */
    function a_admin_can_create_a_user()
    {
        $this->be($this->someUser());

        $response = $this->post(route('users.store'), [
            'name' => 'UN USUARIO',
            'email' => 'UN_USUARIO@MAIL.COM',
            'password' => '123456',
        ])
        ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'UN USUARIO',
            'email' => 'UN_USUARIO@MAIL.COM',
        ]);
    }

    /**
     * @testdox Un usuario administrador puede ver la lista de usuarios
     * @test
     */
    function a_user_admin_can_see_the_list_of_users()
    {
        $user = $this->create(User::class);

        $this->actingAs($user)->assertAuthenticated();

        $response = $this->get(route('users.index'))->assertOk();
    }

    /**
     * @testdox Un administrador puede editar los datos de un usuario
     * @test
     */
    function a_admin_can_edit_a_user()
    {
        $this->withoutExceptionHandling();

        $user = $this->create(User::class);

        $this->be($this->someUser());

        $response = $this->put(route('users.update', $user->id), [
            'name' => 'OTRO USUARIO',
            'email' => 'OTRO_CORREO@MAIL.COM',
            'password' => '',
        ])
        ->assertRedirect(route('users.show', $user->id));

        $user = User::find($user->id);

        $this->assertSame('OTRO_CORREO@MAIL.COM', $user->email);
    }
}
