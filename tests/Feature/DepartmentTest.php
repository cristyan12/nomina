<?php

namespace Tests\Feature;

use App\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class DepartmentTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_user_can_load_the_new_department_office()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('departments.create'))
            ->assertStatus(200)
            ->assertViewIs('departments.create')
            ->assertSee('Departamentos');
    }

    /** @test */
    function a_user_can_create_a_new_department_office()
    {
        $response = $this->actingAs($this->someUser())
            ->post(route('departments.store'), [
                'name' => 'Tecnología'
            ])->assertRedirect(route('departments.index'));

        $this->assertDatabaseHas('departments', ['name' => 'Tecnología']);
    }

    /** @test */
    function a_user_can_can_show_a_list_of_department()
    {
        $departments = factory(Department::class, 10)->create();

        $response = $this->actingAs($this->someUser())
            ->get(route('departments.index'))
            ->assertStatus(200);

        foreach ($departments as $department) {
            $response->assertSee($department->name);
        }
    }

    /** @test */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('departments.index'))
            ->assertStatus(200)
            ->assertSee('No hay Departamentos registrados aún.');
    }

    /** @test */
    function a_name_field_is_required_when_create_a_new_department_office()
    {
        $response = $this->actingAs($this->someUser())
            ->from(route('departments.index'))
            ->post(route('departments.store'), [
                'name' => ''
            ])
            ->assertRedirect(route('departments.store'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Department::count());
    }

    /** @test */
    function a_user_can_load_the_page_of_details_of_department()
    {
        $department = $this->create(Department::class, [
            'name' => 'Tecnología',
        ]);

        $this->actingAs($this->someUser())
            ->get(route('departments.show', $department->id))
            ->assertStatus(200)
            ->assertViewIs('departments.show')
            ->assertViewHas('department')
            ->assertSee('Tecnología');
    }

    /** @test */
    function a_user_can_load_the_form_to_update_department()
    {
        $department = $this->create(Department::class, [
            'name' => 'Tecnología'
        ]);

        $this->actingAs($this->someUser())
            ->get(route('departments.edit', $department->id))
            ->assertStatus(200)
            ->assertViewIs('departments.edit')
            ->assertViewHas('department')
            ->assertSee('Tecnología');
    }

    /** @test */
    function a_user_can_update_the_department()
    {
        $this->withoutExceptionHandling();
        
        $department = $this->create(Department::class);

        $response = $this->actingAs($this->someUser())
            ->put(route('departments.update', $department), [
                'name' => 'Agencia Guanare II (107)',
            ])
            ->assertRedirect(route('departments.show', $department));

        $department = Department::first();
        $this->assertSame('Agencia Guanare II (107)', $department->name);
    }
}
