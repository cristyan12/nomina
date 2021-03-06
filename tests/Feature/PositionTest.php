<?php

namespace Tests\Feature;

use App\Models\Position;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_creation_of_position_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->someUser())
            ->get(route('positions.create'))
            ->assertStatus(200)
            ->assertViewIs('positions.create');
    }

    /** @test */
    function a_user_can_show_a_list_of_positions()
    {
        $positions = Position::factory()->count(10)->create();

        $response = $this->actingAs($this->someUser())
            ->get(route('positions.index'))
            ->assertStatus(200);

        foreach ($positions as $position) {
            $response->assertSee($position->code);
            $response->assertSee($position->name);
        }
    }

    /** @test */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('positions.index'))
            ->assertStatus(200)
            ->assertSee('No hay cargos registrados aún.');
    }

    /** @test */
    function a_user_can_create_a_new_position()
    {
        $user = $this->someUser();

        $response = $this->actingAs($user)
            ->post(route('positions.store'), [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ])->assertRedirect(route('positions.index'));

        $this->assertDatabaseHas('positions', [
            'code' => 'OPE01',
            'name' => 'PERFORADOR',
            'basic_salary' => '105324.30',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    function a_user_can_loads_the_position_details()
    {
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
            ->assertSee('105.324,31');
    }

    /** @test */
    function the_code_field_is_required()
    {
        $this->actingAs($this->someUser())
            ->from(route('positions.index'))
            ->post(route('positions.store'), [
                'code' => '',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ])
            ->assertRedirect(route('positions.store'))
            ->assertSessionHasErrors(['code']);

        $this->assertEquals(0, Position::count());
    }

    /** @test */
    function the_code_field_must_be_unique()
    {
        $position = $this->create(Position::class, [
            'code' => 'OPE01'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('positions.index'))
            ->post(route('positions.store', [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ]))
            ->assertRedirect(route('positions.store'))
            ->assertSessionHasErrors(['code']);

        $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_name_field_is_required()
    {
        $position = $this->create(Position::class);

        $this->from(route('positions.index'))
            ->actingAs($this->someUser())
            ->post(route('positions.store'), [
                'code' => 'OPE01',
                'name' => '',
                'basic_salary' => '105324.30'
            ])
            ->assertRedirect(route('positions.store'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_name_field_must_be_unique()
    {
        $position = $this->create(Position::class, [
            'name' => 'PERFORADOR'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('positions.index'))
            ->post(route('positions.store', [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ]))
            ->assertRedirect(route('positions.store'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_basic_salary_field_is_required()
    {
        $position = $this->create(Position::class);

        $this->from(route('positions.index'))
            ->actingAs($this->someUser())
            ->post(route('positions.store'), [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => ''
            ])
            ->assertRedirect(route('positions.store'))
            ->assertSessionHasErrors(['basic_salary']);

        $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_basic_salary_is_show_with_correct_format()
    {
        $position = $this->create(Position::class, [
            'basic_salary' => '123423.30',
        ]);

        $response = $this->actingAs($this->someUser())
            ->get(route('positions.show', $position))
            ->assertStatus(200)
            ->assertSee('123.423,30');
    }

    /** @test */
    function a_user_can_load_the_form_to_update_position()
    {
        $this->withoutExceptionHandling();

        $position = $this->create(Position::class, [
            'code' => 'OPE01',
            'name' => 'PERFORADOR',
            'basic_salary' => '123456.23'
        ]);

        $this->actingAs($this->someUser())
            ->get("positions/{$position->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('positions.edit')
            ->assertViewHas('position')
            ->assertSee('OPE01')
            ->assertSee('PERFORADOR')
            ->assertSee('123456.23');
    }

    /** @test */
    function a_user_can_update_the_position()
    {
        $this->withoutExceptionHandling();

        $position = $this->create(Position::class);
        $user = $this->someUser();

        $response = $this->actingAs($user)
            ->put(route('positions.update', $position), [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => '123456.56'
            ])
            ->assertRedirect(route('positions.show', $position));

        $position = Position::first();
        $this->assertSame('OPE01', $position->code);
        $this->assertSame('PERFORADOR', $position->name);
        $this->assertSame('123456.56', $position->basic_salary);
        $this->assertEquals($user->id, $position->user_id);
    }

    /** @test */
    function the_code_field_is_required_when_is_updated()
    {
        $position = $this->create(Position::class);

        $this->actingAs($this->someUser())
            ->from(route('positions.edit', $position->id))
            ->put(route('positions.update', $position->id), [
                'code' => '',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ])
            ->assertRedirect(route('positions.edit', $position->id))
            ->assertSessionHasErrors(['code']);

        $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_code_field_must_be_unique_when_is_updated()
    {
        // $this->withoutExceptionHandling();

        $this->create(Position::class, [
            'code' => 'code1'
        ]);

        $position = $this->create(Position::class, [
            'code' => 'OPE01'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('positions.edit', $position->id))
            ->put(route('positions.update', $position->id), [
                'code' => 'code1',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ])
            ->assertRedirect(route('positions.edit', $position->id))
            ->assertSessionHasErrors(['code']);

        // $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_name_field_is_required_when_is_updated()
    {
        $position = $this->create(Position::class);

        $this->actingAs($this->someUser())
            ->from(route('positions.edit', $position->id))
            ->put(route('positions.update', $position->id), [
                'code' => 'OPE01',
                'name' => '',
                'basic_salary' => '105324.30'
            ])
            ->assertRedirect(route('positions.edit', $position->id))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Position::count());
    }

    /** @test */
    function the_basic_salary_field_is_required_when_is_updated()
    {
        $position = $this->create(Position::class);

        $this->actingAs($this->someUser())
            ->from(route('positions.edit', $position->id))
            ->put(route('positions.update', $position->id), [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => ''
            ])
            ->assertRedirect(route('positions.edit', $position->id))
            ->assertSessionHasErrors(['basic_salary']);

        $this->assertEquals(1, Position::count());
    }
}
