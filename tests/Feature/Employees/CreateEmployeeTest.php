<?php

namespace Tests\Feature;

use App\{Employee, EmployeeProfile};

use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class CreateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected $attributes;

    public function setUp()
    {
        parent::setUp();

        $this->actingAs($this->someuser());

        $this->attributes = [
            'code' => '14996210',
            'document' => '14996210',
            'last_name' => 'Valera Rodriguez',
            'first_name' => 'Cristyan Josuan',
            'rif' => 'V149962103',
            'born_at' => '1981-12-21',
            'civil_status' => 'Casado/a',
            'sex' => 'M',
            'nationality' => 'V',
            'city_of_born' => 'Guanare',
            'hired_at' => '2012-08-30',
            'profession_id' => $this->create(\App\Profession::class)->id,
            'status' => 'Activo',
            'bank_id' => $this->create(\App\Bank::class)->id,
            'account_number' => '01750107160071661898',
            'contract' => 'I',
            'branch_id' => $this->create(\App\Branch::class)->id,
            'department_id' => $this->create(\App\Department::class)->id,
            'unit_id' => $this->create(\App\Unit::class)->id,
            'position_id' => $this->create(\App\Position::class)->id,
        ];

        // $this->withoutExceptionHandling();
    }

    /** @test */
    function a_user_can_load_the_new_employee_page()
    {
        $response = $this->get(route('employees.create'))
            ->assertStatus(200)
            ->assertViewIs('employees.create')
            ->assertSee('Registrar Empleado');
    }

    /** @test */
    function a_user_can_create_a_employee()
    {
        $response = $this->actingAs($user = $this->someUser())
            ->post(route('employees.store'), $this->attributes)
            ->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', [
            'code' => '14996210',
            'last_name' => 'Valera Rodriguez',
            'first_name' => 'Cristyan Josuan',
            'born_at' => '1981-12-21',
            'hired_at' => '2012-08-30',
            'user_id' => $user->id,
        ]);

        $empleado = \App\Employee::first();

        $this->assertDatabaseHas('employee_profiles', [
            'employee_id' => $empleado->id,
            'profession_id' => $this->attributes['profession_id'],
            'status' => 'Activo',
            'bank_id' => $this->attributes['bank_id'],
            'account_number' => '01750107160071661898',
            'contract' => 'I',
            'branch_id' => $this->attributes['branch_id'],
            'department_id' => $this->attributes['department_id'],
            'unit_id' => $this->attributes['unit_id'],
            'position_id' => $this->attributes['position_id'],
        ]);
    }

    /** @test */
    function a_user_can_show_a_details_employee_data()
    {
        $this->withoutExceptionHandling();

        $employee = $this->create(Employee::class, [
        	'first_name' => 'EMPLEADO',
        	'last_name' => 'DE PRUEBA',
        ]);
        $perfil = $this->create(EmployeeProfile::class, ['employee_id' => $employee->id]);

        $this->get(route('employees.show', $employee->id))
            ->assertStatus(200)
            ->assertViewIs('employees.show')
            ->assertViewHas('employee')
            ->assertSee($employee->code)
            ->assertSee($employee->document)
            ->assertSee('EMPLEADO DE PRUEBA');
    }

    // VALIDATION

    /** @test */
    function the_code_field_is_required()
    {
        $replace = array_replace($this->attributes, ['code' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['code']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_document_field_is_required()
    {
        $replace = array_replace($this->attributes, ['document' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['document']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_code_field_must_be_equal_to_the_document_field()
    {
        $replace = array_replace($this->attributes, [
            'code' => '14996211'
        ]);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['code']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_document_field_must_be_unique()
    {
        $employee = $this->create(Employee::class, [
            'document' => '14996210'
        ]);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $this->attributes)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['document']);

        $this->assertEquals(1, Employee::count());
    }

    /** @test */
    function the_last_name_field_is_required()
    {
        $replace = array_replace($this->attributes, ['last_name' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['last_name']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_first_name_field_is_required()
    {
        $replace = array_replace($this->attributes, ['first_name' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['first_name']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_rif_field_is_required()
    {
        $replace = array_replace($this->attributes, ['rif' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['rif']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_born_at_field_is_required()
    {
        $replace = array_replace($this->attributes, ['born_at' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['born_at']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_born_at_field_must_be_a_real_date()
    {
        $replace = array_replace($this->attributes, ['born_at' => '123456789']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['born_at']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_sex_field_is_required()
    {
        $replace = array_replace($this->attributes, ['sex' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['sex']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_city_of_born_field_is_required()
    {
        $replace = array_replace($this->attributes, ['city_of_born' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['city_of_born']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_hired_at_field_is_required()
    {
        $replace = array_replace($this->attributes, ['hired_at' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_hired_at_field_must_be_a_real_date()
    {
        $replace = array_replace($this->attributes, ['hired_at' => 'abdfretfsd']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_hired_at_field_must_be_a_different_of_born_at_field()
    {
        $replace = array_replace($this->attributes, ['hired_at' => '1981-12-21']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_hired_at_field_must_be_a_after_of_born_at_field()
    {
        $replace = array_replace($this->attributes, ['hired_at' => '1980-12-21']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_profession_id_field_is_required()
    {
        $replace = array_replace($this->attributes, ['profession_id' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['profession_id']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_contract_field_is_required()
    {
        $replace = array_replace($this->attributes, ['contract' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['contract']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_bank_id_field_is_required()
    {
        $replace = array_replace($this->attributes, ['bank_id' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['bank_id']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_account_number_field_is_required()
    {
        $replace = array_replace($this->attributes, ['account_number' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['account_number']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_branch_id_field_is_required()
    {
        $replace = array_replace($this->attributes, ['branch_id' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['branch_id']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_department_id_field_is_required()
    {
        $replace = array_replace($this->attributes, ['department_id' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['department_id']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_unit_id_field_is_required()
    {
        $replace = array_replace($this->attributes, ['unit_id' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['unit_id']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }

    /** @test */
    function the_position_id_field_is_required()
    {
        $replace = array_replace($this->attributes, ['position_id' => '']);

        $this->from(route('employees.index'))
            ->post(route('employees.store'), $replace)
            ->assertRedirect(route('employees.store'))
            ->assertSessionHasErrors(['position_id']);

        $this->assertEquals(0, Employee::count());
        $this->assertEquals(0, EmployeeProfile::count());
    }
}
