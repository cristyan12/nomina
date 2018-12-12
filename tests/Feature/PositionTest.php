<?php

namespace Tests\Feature;

use App\Position;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_load_the_creation_of_position_page()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('positions.create'))
            ->assertStatus(200)
            ->assertViewIs('positions.create')
            ->assertSee('Crear Cargo');
    }

    /** @test */
    public function a_user_can_show_a_list_of_positions()
    {
        $positions = factory(Position::class, 10)->create();

        $response = $this->get(route('positions.index'))
            ->assertStatus(200);

        foreach ($positions as $position) {
            $response->assertSee($position->code);
            $response->assertSee($position->name);
            $response->assertSee($position->basic_salary);
        }
    }

    /** @test */
    public function it_show_a_message_when_no_records_yet()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('positions.index'))
            ->assertStatus(200)
            ->assertSee('No hay cargos registrados aún.');
    }

    /** @test */
    public function a_user_can_create_a_new_position()
    {
        $response = $this->actingAs($this->someUser())
            ->post(route('positions.store'), [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ])->assertRedirect(route('positions.index'));

        $this->assertDatabaseHas('positions', [
            'code' => 'OPE01',
            'name' => 'PERFORADOR',
            'basic_salary' => '105324.30'
        ]);
    }

    /** @test */
    public function a_user_can_loads_the_position_details()
    {
        $this->withoutExceptionhandling();

        $position = $this->create(Position::class, [
            'code' => 'OPE01',
            'name' => 'PERFORADOR',
            'basic_salary' => '105324.31'
        ]);

        $response = $this->actingAs($this->someUser())
            ->get(route('positions.show', $position))
            ->assertStatus(200)
            ->assertViewIs('positions.show')
            ->assertViewHas('position')
            ->assertSee('OPE01')
            ->assertSee('PERFORADOR')
            ->assertSee('105324.31');
    }
}
