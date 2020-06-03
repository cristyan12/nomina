<?php

namespace Tests\Feature\Nominas;

use Tests\TestCase;
use App\{Employee, Nomina, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectNominaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_admin_can_select_a_type_of_nomina_from_a_list()
    {
        $user = factory(User::class)->create();
        $nomina = factory(Nomina::class)->make([
            'name' => 'Nomina Semanal',
            'type' => 'Semanal'
        ]);
        $user->nominas()->save($nomina);

        $employee = factory(Employee::class)->create([
            'first_name' => 'Cristyan',
            'last_name' => 'Valera',
            'nomina_id' => $nomina->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('nomina.selected', $nomina));

        $response->assertStatus(200)
            ->assertViewIs('nomina.selected')
            ->assertSee('Nomina Semanal')
            ->assertSee('Cristyan Valera');
    }
}
