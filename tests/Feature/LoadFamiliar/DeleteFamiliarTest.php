<?php

namespace Tests\Feature\LoadFamiliar;

use Tests\TestCase;
use App\{Employee, LoadFamiliar};
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteFamiliarTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_user_can_delete_a_load_familiar()
    {
        $employee = $this->create(Employee::class);
        $familiar = $this->create(LoadFamiliar::class, ['employee_id' => $employee->id]);

        $response = $this->actingAs($this->someUser())
            ->from(route('familiars.index', $employee))
            ->delete(route('familiars.destroy', $familiar))
            ->assertRedirect(route('familiars.index', $employee));

        $this->assertEquals(0, LoadFamiliar::count());
    }

    /** @test */
    function if_a_employee_is_deleted_then_his_familiars_too_must_be_deleted()
    {
        $employee = $this->create(Employee::class);
        $familiar = $this->create(LoadFamiliar::class, ['employee_id' => $employee->id]);

        $response = $this->actingAs($this->someUser())
            ->delete(route('employees.destroy', $employee));

        $this->assertSame(0, Employee::count());
        $this->assertSame(0, LoadFamiliar::count());
    }
}
