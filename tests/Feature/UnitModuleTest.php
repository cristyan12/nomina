<?php

namespace Tests\Feature;

use App\Department;
use App\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function a_user_can_load_the_new_unit_page()
    {
        $response = $this->actingAs($user = $this->someUser())
            ->get(route('units.create'))
            ->assertStatus(200)
            ->assertViewIs('units.create');
    }

    /** @test */
    function a_user_can_create_a_new_unit()
    {
        // Arrange
        $attributes = ['name' => $this->faker->sentence];

        // Act
        $response = $this->actingAs($user = $this->someUser())
            ->post(route('units.store'), $attributes);

        // Assert
        $response->assertRedirect(route('units.index'));

        $this->assertDatabaseHas('units', $attributes);
    }

    /** @test */
    function a_user_can_see_a_list_of_a_units()
    {
        // Arrange
        $units = factory(Unit::class, 10)->create();

        // Act
        $response = $this->actingAs($user = $this->someUser())
            ->get(route('units.index'));

        // Assert
        $response->assertStatus(200)
            ->assertViewIs('units.index')
            ->assertViewHas('units');

        foreach ($units as $unit) {
            $response->assertSee(e($unit->name));
        }
    }

    /** @test */
    function a_user_can_see_a_details_of_a_unit()
    {
        // Arrange
        $unit = $this->create(Unit::class);

        // Act
        $response = $this->actingAs($this->someUser())
            ->get(route('units.show', $unit));

        // Assert
        $response->assertStatus(200)
            ->assertViewIs('units.show')
            ->assertViewHas('unit')
            ->assertSee($unit->name);
    }

    /** @test */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('units.index'))
            ->assertStatus(200)
            ->assertSee('No hay Unidades de producción registradas aún.');
    }

    /** @test */
    function a_name_field_is_required_when_create_a_new_unit()
    {
        $response = $this->actingAs($this->someUser())
            ->from(route('units.index'))
            ->post(route('units.store'), [
                'name' => ''
            ])
            ->assertRedirect(route('units.store'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Unit::count());
    }

    /** @test */
    function a_user_can_load_the_form_to_update_unit()
    {
        $unit = $this->create(Unit::class, [
            'name' => 'Tecnología'
        ]);

        $this->actingAs($this->someUser())
            ->get(route('units.edit', $unit->id))
            ->assertStatus(200)
            ->assertViewIs('units.edit')
            ->assertViewHas('unit')
            ->assertSee(e('Tecnología'));
    }

    /** @test */
    function a_user_can_update_the_unit()
    {
        $this->withoutExceptionHandling();

        $unit = $this->create(Unit::class);

        $response = $this->actingAs($this->someUser())
            ->put(route('units.update', $unit), [
                'name' => 'Auditoria interna',
            ])
            ->assertRedirect(route('units.show', $unit));

        $unit = Unit::first();
        $this->assertSame('Auditoria interna', $unit->name);
    }
}
