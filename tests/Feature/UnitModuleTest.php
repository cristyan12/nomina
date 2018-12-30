<?php

namespace Tests\Feature;

use App\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitModuleTest extends TestCase
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
        $user = $this->someUser();

        $attributes = ['name' => $this->faker->sentence];

        // Act
        $response = $this->actingAs($user)
            ->post(route('units.store'), $attributes);

        // Assert
        $response->assertRedirect(route('units.index'));

        $this->assertDatabaseHas('units', $attributes);
    }

    /** @test */
    function a_user_can_see_a_list_of_a_units()
    {
        $this->withoutExceptionHandling();

        // Arrange
        $units = $this->create(\App\Unit::class, 10);

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
        $user = $this->someUser();

        $unit = $this->create(\App\Unit::class);

        // Act
        $response = $this->get(route('units.show', $unit));

        // Assert
        $response->assertStatus(200)
            ->assertViewIs('units.show')
            ->assertViewHas('unit')
            ->assertSee($unit->name);
    }
}
