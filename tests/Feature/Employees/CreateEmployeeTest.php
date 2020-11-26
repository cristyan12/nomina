<?php

namespace Tests\Feature\Employees;

use App\Models\Bank;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeProfile;
use App\Models\Nomina;
use App\Models\Position;
use App\Models\Profession;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected $attributes;

    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->someUser());

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
            'profession_id' => Profession::factory()->create()->id,
            'status' => 'Activo',
            'bank_id' => Bank::factory()->create()->id,
            'account_number' => '01750107160071661898',
            'contract' => 'I',
            'branch_id' => Branch::factory()->create()->id,
            'department_id' => Department::factory()->create()->id,
            'unit_id' => Unit::factory()->create()->id,
            'position_id' => Position::factory()->create()->id,
            'nomina_id' => Nomina::factory()->create()->id,
        ];

        // $this->withoutExceptionHandling();
    }

    /** @test */
    function a_user_can_load_the_new_employee_page()
    {
        // $this->withoutExceptionHandling();

        $response = $this->get(route('employees.create'))
            ->assertStatus(200)
            ->assertViewIs('employees.create')
            ->assertSee('Registrar Empleado');
    }

    /** @test */
    function a_user_can_create_a_employee()
    {
        $this->withoutExceptionHandling();

        $user = $this->someUser();

        $response = $this->actingAs($user)
            ->post(route('employees.store'), $this->attributes)
            ->assertRedirect(route('employees.index'));

        $emp = Employee::first();

        $this->assertSame('14996210', $emp->code);
        $this->assertSame('Valera Rodriguez', $emp->last_name);
        $this->assertSame('Cristyan Josuan', $emp->first_name);
        $this->assertEquals($user->id, $emp->user_id);

        $profile = EmployeeProfile::first();
        $this->assertEquals($emp->id, $profile->employee_id);
        $this->assertEquals($this->attributes['profession_id'], $profile->profession_id);
        $this->assertEquals($this->attributes['bank_id'], $profile->bank_id);
        $this->assertEquals($this->attributes['branch_id'], $profile->branch_id);
        $this->assertEquals($this->attributes['department_id'], $profile->department_id);
        $this->assertEquals($this->attributes['unit_id'], $profile->unit_id);
        $this->assertEquals($this->attributes['position_id'], $profile->position_id);
    }

    /** @test */
    function a_user_can_show_a_details_employee_data()
    {
        $employee = $this->create(Employee::class, [
        	'first_name' => 'EMPLEADO',
        	'last_name' => 'DE PRUEBA',
        ]);
        $perfil = $employee->profile()->save($this->make(EmployeeProfile::class));

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
