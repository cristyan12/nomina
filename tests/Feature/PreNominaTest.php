<?php

namespace Tests\Feature;

use App\{Employee, EmployeeProfile, Nomina};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreNominaTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $employee;
    protected $nomina;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->someUser();
        $this->actingAs($this->user);

        $this->nomina = $this->create(Nomina::class);

        $this->employee = $this->create(Employee::class);
        $this->employee->profile()->save($this->make(EmployeeProfile::class));

        // $this->withoutExceptionHandling();
    }

    /** @test */
    function a_admin_can_select_a_type_of_nomina_from_a_list()
    {
        $response = $this->get(route('pre-nominas.show', $this->nomina));

        $response->assertStatus(200)
            ->assertViewIs('pre-nominas.show')
            ->assertViewHas('nomina');
    }

    /** @test */
    function muestra_la_pagina_de_carga_de_los_datos_de_la_nomina()
    {
        $this->employee = $this->create(Employee::class, [
            'first_name' => 'Cristyan',
            'last_name' => 'Valera',
            'nomina_id' => $this->nomina->id,
        ]);

        $response = $this->get("pre-nominas/{$this->nomina->id}/{$this->employee->id}/create")
            ->assertOk()
            ->assertViewIs('pre-nominas.create')
            ->assertViewHasAll(['nomina', 'employee'])
            ->assertSee($this->nomina->name)
            ->assertSee($this->employee->full_name);
    }
}
