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
        $this->withoutExceptionHandling();

        $response = $this->get(route('employees.create'))
            ->assertStatus(200)
            ->assertViewIs('employees.create')
            ->assertSee('Crear Empleado');
    }

    /** @test */
    function a_user_can_create_a_employee()
    {
        $this->withoutExceptionHandling();

        $profession = $this->create(\App\Profession::class);

        $bankOfPay = $this->create(\App\BankOfPay::class, [
            'code' => '0175',
            'name' => 'Banco Bicentenario',
        ]);
        $branch = $this->create(\App\Branch::class);
        $department = $this->create(\App\Department::class);
        $unit = $this->create(\App\Unit::class);
        $position = $this->create(\App\Position::class);

        $attributes = [
            'code' => '14996210',
            'document' => '14996210',
            'last_name' => 'Valera Rodriguez',
            'first_name' => 'Cristyan Josuan',
            'rif' => 'V149962103',
            'born_at' => '1981-12-21',
            'marital_status' => 'Casado/a',
            'sex' => 'M',
            'nationality' => 'V',
            'city_of_born' => 'Guanare',
            'hired_at' => '2012-08-30',
            'profession_id' => $profession->id,
            'status' => 'Activo',
            'bank_pay_id' => $bankOfPay->id,
            'account_number' => '01750107160071661898',
            'contract' => 'I',
            'branch_id' => $branch->id,
            'department_id' => $department->id,
            'unit_id' => $unit->id,
            'position_id' => $position->id,
        ];

        $response = $this->actingAs($this->someuser())
            ->post(route('employees.store'), $attributes)
            ->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', [
            'code' => '14996210',
            'last_name' => 'Valera Rodriguez',
            'first_name' => 'Cristyan Josuan',
            'born_at' => '1981-12-21',
            'hired_at' => '2012-08-30',
        ]);

        $employee = \App\Employee::first();

        $this->assertDatabaseHas('employee_profiles', [
            'employee_id' => $employee->id,
            'profession_id' => $profession->id,
            'status' => 'Activo',
            'bank_pay_id' => $bankOfPay->id,
            'account_number' => '01750107160071661898',
            'contract' => 'I',
            'branch_id' => $branch->id,
            'department_id' => $department->id,
            'unit_id' => $unit->id,
            'position_id' => $position->id,
        ]);
    }
}
