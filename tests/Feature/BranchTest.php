<?php

namespace Tests\Feature;

use App\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BranchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_new_branch_office()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('branches.create'))
            ->assertStatus(200)
            ->assertViewIs('branches.create')
            ->assertSee('Sucursales')
            ->assertSee('Crear Sucursal');
    }

    /** @test */
    function a_user_can_create_a_new_branch_office()
    {
        $response = $this->actingAs($this->someUser())
            ->post(route('branches.store'), [
                'name' => 'Sucursal 1'
            ])->assertRedirect(route('branches.index'));

        $this->assertDatabaseHas('branches', ['name' => 'Sucursal 1']);
    }

    /** @test */
    function a_user_can_can_show_a_list_of_branch_offices()
    {
        $this->withoutExceptionHandling();

        $branches = factory(Branch::class, 10)->create();

        $response = $this->get(route('branches.index'))
            ->assertStatus(200);

        foreach ($branches as $branch) {
            $response->assertSee($branch->name);
        }
    }

    /** @test */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->get(route('branches.index'))
            ->assertStatus(200)
            ->assertSee('No hay sucursales registradas aún.');
    }

    /** @test */
    function a_name_field_is_required_when_create_a_new_branch_office()
    {
        $response = $this->actingAs($this->someUser())
            ->from(route('branches.index'))
            ->post(route('branches.store'), [
                'name' => ''
            ])
            ->assertRedirect(route('branches.store'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Branch::count());
    }

    /** @test */
    function a_user_can_load_the_page_of_details_of_branch()
    {
        $this->withoutExceptionHandling();

        $branch = $this->create(Branch::class, [
            'name' => 'PRINCIPAL',
        ]);

        $this->actingAs($this->someUser())
            ->get(route('branches.show', $branch->id))
            ->assertStatus(200)
            ->assertViewIs('branches.show')
            ->assertViewHas('branch')
            ->assertSee('Sucursal')
            ->assertSee('PRINCIPAL');
    }

    /** @test */
    function a_user_can_load_the_form_to_update_branch()
    {
        $this->withoutExceptionHandling();

        $branch = $this->create(Branch::class, [
            'name' => 'Agencia Guanare II (107)'
        ]);

        $this->actingAs($this->someUser())
            ->get(route('branches.edit', $branch->id))
            ->assertStatus(200)
            ->assertViewIs('branches.edit')
            ->assertViewHas('branch')
            ->assertSee('Agencia Guanare II (107)');
    }

    /** @test */
    function a_user_can_update_the_branch()
    {
        // $this->withoutExceptionHandling();

        $branch = $this->create(Branch::class);

        $response = $this->actingAs($this->someUser())
            ->put(route('branches.update', $branch), [
                'name' => 'Agencia Guanare II (107)',
            ])
            ->assertRedirect(route('branches.show', $branch));

        $branch = Branch::first();
        $this->assertSame('Agencia Guanare II (107)', $branch->name);
    }
}
