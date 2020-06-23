<?php

namespace Tests\Feature\Nominas;

use App\{Employee, EmployeeProfile, Nomina, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SelectNominaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_admin_can_select_a_type_of_nomina_from_a_list()
    {
        $this->withoutExceptionHandling();

        $user = $this->someUser();

        $nomina = $this->make(Nomina::class, [
            'name' => 'Nomina Semanal',
        ]);
        $user->nominas()->save($nomina);

        $employee = $this->create(Employee::class, [
            'first_name' => 'Cristyan',
            'last_name' => 'Valera',
            'nomina_id' => $nomina->id,
        ]);
        $employee->profile()->save($this->make(EmployeeProfile::class));

        $response = $this->actingAs($user)
            ->get(route('nomina.selected', $nomina));

        $response->assertStatus(200)
            ->assertViewIs('nomina.selected')
            ->assertViewHas('nomina')
            ->assertSee('Nomina Semanal')
            ->assertSee('Cristyan Valera');
    }

    /** @test */
    function muestra_la_pagina_de_edicion_de_los_datos_de_la_nomina()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->someUser());

        $nomina = $this->create(Nomina::class, [
            'name' => 'Nomina Semanal',
        ]);

        $employee = $this->create(Employee::class, [
            'first_name' => 'Cristyan',
            'last_name' => 'Valera',
            'nomina_id' => $nomina->id,
        ]);

        $response = $this->get("pre-nominas/{$nomina->id}/{$employee->id}/create")
            ->assertOk()
            ->assertViewIs('pre-nominas.create')
            ->assertViewHasAll(['nomina', 'employee'])
            ->assertSee($nomina->name)
            ->assertSee($employee->full_name);
    }
}
