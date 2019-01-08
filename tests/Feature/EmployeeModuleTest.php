<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_new_employee_page()
    {
        $response = $this->get(route('employees.create'))
            ->assertStatus(200)
            ->assertViewIs('employees.create')
            ->assertSee('Crear Empleado');
    }

    /** @test */
    function a_user_can_create_a_employee_with_data_personal()
    {
        $profession = $this->create(\App\Profession::class);
        $contract = $this->create(\App\Contract::class);

        $attributes = [
            'code' => '14996210',
            'document' => '14996210',
            'last_name' => 'Valera Rodriguez',
            'first_name' => 'Cristyan Josuan',
            'rif' => 'V149962103',
            'born_at' => '1981-12-21',
            'marital_status' => 'Casado/a',
            'sex' => 'M',
            'nationality' => 'Venezolana',
            'city_of_born' => 'Guanare',
            'hired_at' => '2012-08-30',
            'profession_id' => $profession->id,
            'contract_id' => $contract->id,
            'status' => 'Activo'
        ];

        $response = $this->actingAs($this->someuser())
            ->post(route('employees.store'), $attributes)
            ->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', $attributes);
    }
}
