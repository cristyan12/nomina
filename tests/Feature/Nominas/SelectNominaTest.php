<?php

namespace Tests\Feature\Nominas;

use App\EmployeeProfile;
use App\{Employee, Nomina, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SelectNominaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_admin_can_select_a_type_of_nomina_from_a_list()
    {
        $user = $this->someUser();
        $nomina = $this->create(Nomina::class, [
            'name' => 'Nomina Semanal',
            'type' => 'Semanal',
        ]);
        $user->nominas()->save($nomina);

        $employee = $this->create(Employee::class, [
            'first_name' => 'Cristyan',
            'last_name' => 'Valera',
            'nomina_id' => $nomina->id,
        ]);
        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id
        ]);

        $response = $this->actingAs($user)
            ->get(route('nomina.selected', $nomina));

        $response->assertStatus(200)
            ->assertViewIs('nomina.selected')
            ->assertViewHas('nomina')
            ->assertSee('Nomina Semanal')
            ->assertSee('Cristyan Valera');
    }
}
