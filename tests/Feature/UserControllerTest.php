<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{User, RoleUser};
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

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
     * @testdox Un usuario sin privilegios de administrador no puede ver la lista de usuarios
     * @test 
     */
    function a_user_cannot_see_the_page_list_of_users()
    {
        $user = factory('App\User')->make();

        $response = $this->actingAs($user)->get(route('users.index'))
            ->assertStatus(403);
    }

    /**
     * @testdox Un usuario sin privilegios de administrador no puede ver el formulario de edición de usuarios
     * @test 
     */
    function a_user_non_admin_cannot_see_the_form_to_edit_users()
    {
        $user = factory('App\User')->create();

        $response = $this->actingAs($user)->get(route('users.edit', $user->id))
            ->assertStatus(403);
    }

    /**
     * @testdox Un usuario sin privilegios de administrador no puede ver el detalle de un usuario dado
     * @test 
     */
    function a_user_non_admin_cannot_see_the_the_page_of_details_of_user()
    {
        $user = factory('App\User')->create();

        $response = $this->actingAs($user)->get(route('users.show', $user->id))
            ->assertStatus(403);
    }

    /**
     * @testdox Un usuario sin privilegios de administrador no puede editar usuarios
     * @test 
     */
    function a_user_non_admin_cannot_update_a_user()
    {
        $user = factory('App\User')->create();

        $response = $this->actingAs($user)->put(route('users.update', $user->id))
            ->assertStatus(403);
    }

    /**
     * @testdox Un usuario sin privilegios de administrador no puede eliminar usuarios
     * @test 
     */
    function a_user_non_admin_cannot_delete_a_user()
    {
        $user = factory('App\User')->create();

        $response = $this->actingAs($user)
            ->delete(route('users.destroy', $user->id))
            ->assertStatus(403);
    }

    /**
     * @testdox Un usuario administrador puede ver la lista de usuarios
     * @test 
     */
    function a_user_admin_can_see_the_list_of_users()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $role = factory(Role::class)->create([
            'name' => 'admin',
            'slug' => 'all-access',
        ]);
        $admin = factory(RoleUser::class)->create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($admin)->assertAuthenticated();

        $response = $this->get(route('users.index'))->assertOk();
    }
}
