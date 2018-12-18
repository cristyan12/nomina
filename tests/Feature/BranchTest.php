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
}
