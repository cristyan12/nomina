<?php

namespace Tests\Feature\Nominas;

use App\Employee;
use App\Nomina;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SelectNominaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_admin_can_select_a_type_of_nomina_from_a_list()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $nomina = factory(Nomina::class)->make([
            'name' => 'Nomina Semanal',
            'type' => 'Semanal'
        ]);
        $user->nominas()->save($nomina);

        $employee = factory(Employee::class)->make([
            'first_name' => 'Cristyan',
            'last_name' => 'Valera',
        ]);
        $user->nominas()->save($employee);

        $response = $this->actingAs($user)
            ->get(route('nomina.selected', $nomina));

        $response->assertStatus(200)
            ->assertViewIs('nomina.selected')
            ->assertSee('Nomina Semanal')
            ->assertSee('Cristyan Valera');
    }
}
