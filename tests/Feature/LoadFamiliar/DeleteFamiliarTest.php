<?php

namespace Tests\Feature\LoadFamiliar;

use Tests\TestCase;
use App\Employee;
use App\LoadFamiliar;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteFamiliarTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_user_can_delete_a_load_familiar()
    {
        $employee = $this->create(Employee::class);
        $familiar = $this->create(LoadFamiliar::class);

        $response = $this->actingAs($this->someUser())
            ->from(route('familiars.index', $employee))
            ->delete(route('familiars.destroy', $familiar))
            ->assertRedirect(route('familiars.index', $employee));

        $this->assertEquals(0, LoadFamiliar::count());
    }
}
