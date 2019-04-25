<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Employee, EmployeeProfile};
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateEmployeeTest extends TestCase
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
            'marital_status' => 'Casado/a',
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
    function a_user_can_load_the_edit_page()
    {
        $this->withoutExceptionHandling();
        
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $response = $this->get(route('employees.edit', $employee))
            ->assertStatus(200)
            ->assertViewIs('employees.edit')
            ->assertViewHas('employee')
            ->assertSee($employee->id)
            ->assertSee($employee->full_name);
    }

    /** @test */
    function a_user_can_update_a_employee()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $response = $this->put(route('employees.update', $employee), $this->attributes)
            ->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', [
            'code' => '14996210',
            'last_name' => 'Valera Rodriguez',
            'first_name' => 'Cristyan Josuan',
            'born_at' => '1981-12-21',
            'hired_at' => '2012-08-30',
        ]);

        $employee = Employee::first(); 

        $this->assertDatabaseHas('employee_profiles', [
            'employee_id' => $employee->id,
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
    function the_code_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['code' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['code']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_document_field_is_required_when_updating_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['document' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['document']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_code_field_must_be_equal_to_the_document_field_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, [
            'code' => '14996211'
        ]);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['code']);
        
        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_document_field_must_be_unique_when_updating()
    {
        $this->create(Employee::class, [
            'document' => '14996210'
        ]);

        $employee = $this->create(Employee::class);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $this->attributes)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['document']);

        $this->assertDatabaseHas('employees', ['document' => '14996210']);
    }

    /** @test */
    function the_last_name_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['last_name' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['last_name']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_first_name_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['first_name' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['first_name']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_rif_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['rif' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['rif']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_born_at_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['born_at' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['born_at']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_born_at_field_must_be_a_real_date_when_updating()
    {
       $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['born_at' => '12345678912']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['born_at']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_sex_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['sex' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['sex']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_city_of_born_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['city_of_born' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['city_of_born']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_hired_at_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['hired_at' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_hired_at_field_must_be_a_real_date_when_updating()
    {
		$employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['hired_at' => 'abdfretfsd']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function la_fecha_de_contratación_debe_ser_diferente_a_la_fecha_de_nacimiento()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['hired_at' => '1981-12-21']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_hired_at_field_must_be_a_after_of_born_at_field_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['hired_at' => '1981-12-21']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['hired_at']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_profession_id_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['profession_id' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['profession_id']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_contract_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['contract' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['contract']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_bank_id_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['bank_id' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['bank_id']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_account_number_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['account_number' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['account_number']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_branch_id_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['branch_id' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['branch_id']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_department_id_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['department_id' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['department_id']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_unit_id_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['unit_id' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['unit_id']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }

    /** @test */
    function the_position_id_field_is_required_when_updating()
    {
        $employee = $this->create(Employee::class);

        $profile = $this->create(EmployeeProfile::class, [
            'employee_id' => $employee->id,
        ]);

        $replace = array_replace($this->attributes, ['position_id' => '']);

        $this->from(route('employees.edit', $employee->id))
            ->put(route('employees.update', $employee->id), $replace)
            ->assertRedirect(route('employees.edit', $employee->id))
            ->assertSessionHasErrors(['position_id']);

        $this->assertDatabaseMissing('employees', [
            'first_name' => 'Cristyan Josuan'
        ]);
        
        $this->assertDatabaseMissing('employee_profiles', [
            'account_number' => '01750107160071661898'
        ]);
    }
}
