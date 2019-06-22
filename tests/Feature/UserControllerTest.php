<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{User, RoleUser};
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
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

        $user = \App\User::first();

        $this->assertSame('Cristyan Valera', $user->name);
        $this->assertSame('numenor21@gmail.com', $user->email);
    }

    /**
     * @testdox Un usuario administrador puede ver la lista de usuarios
     * @test 
     */
    function a_user_admin_can_see_the_list_of_users()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create([
            'name' => 'admin',
            'special' => 'all-access',
        ]);
        $admin = factory(RoleUser::class)->create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($admin)->assertAuthenticated();

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
