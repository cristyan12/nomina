<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_new_profession_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->someUser())
            ->get(route('professions.create'))
            ->assertStatus(200)
            ->assertViewIs('professions.create')
            ->assertSee('Profesiones');
    }

    /** @test */
    function a_user_can_create_a_new_profession()
    {
        $response = $this->actingAs($this->someUser())
            ->post(route('professions.store'), [
                'title' => 'Programador web'
            ])
            ->assertRedirect(route('professions.index'));

        $this->assertDatabaseHas('professions', ['title' => 'Programador web']);
    }

    /** @test */
    function a_user_can_see_a_lists_of_professions()
    {
        $professions = factory(App\Models\Profession::class, 10)->create();

        $response = $this->actingAs($this->someUser())
            ->get(route('professions.index'))
            ->assertViewIs('professions.index')
            ->assertViewHas('professions');

        foreach ($professions as $profession) {
            $response->assertSee(e($profession->title));
        }
    }

    /** @test */
    function the_field_title_is_required()
    {
        $this->actingAs($this->someUser())
            ->from(route('professions.index'))
            ->post(route('professions.store'), [
                'title' => ''
            ])
            ->assertRedirect(route('professions.store'))
            ->assertSessionHasErrors(['title']);

        $this->assertEquals(0, App\Models\Profession::count());
    }

    /** @test */
    function the_field_title_must_be_unique()
    {
        $oldTitle = $this->create(App\Models\Profession::class);

        $this->actingAs($this->someUser())
            ->from(route('professions.index'))
            ->post(route('professions.store'), [
                'title' => $oldTitle->title
            ])
            ->assertRedirect(route('professions.store'))
            ->assertSessionHasErrors(['title']);

        $this->assertEquals(1, App\Models\Profession::count());
    }

    /** @test */
    function a_user_can_loads_the_profession_details()
    {
        $profession = $this->create(App\Models\Profession::class);

        $response = $this->actingAs($this->someUser())
            ->get(route('professions.show', $profession))
            ->assertStatus(200)
            ->assertViewIs('professions.show')
            ->assertViewHas('profession')
            ->assertSee($profession->title);
    }

    /** @test */
    function a_user_can_load_the_edit_page_of_profession()
    {
        $profession = $this->create(App\Models\Profession::class);

        $response = $this->actingAs($this->someUser())
            ->get(route('professions.edit', $profession))
            ->assertViewIs('professions.edit')
            ->assertViewHas('profession')
            ->assertSee('Editar profesión #'. $profession->id);
    }

    /** @test */
    function a_user_can_edit_a_profession()
    {
        $profession = $this->create(App\Models\Profession::class);

        $response = $this->actingAs($this->someUser())
            ->put(route('professions.update', $profession), [
                'title' => 'Programador web'
            ])
            ->assertRedirect(route('professions.show', $profession));

        $this->assertDatabaseHas('professions', ['title' => 'Programador web']);
    }

    /** @test */
    function the_field_title_is_required_when_updating()
    {
        $profession = $this->create(App\Models\Profession::class);

        $this->actingAs($this->someUser())
            ->from(route('professions.edit', $profession))
            ->put(route('professions.update', $profession), [
                'title' => ''
            ])
            ->assertRedirect(route('professions.edit', $profession))
            ->assertSessionHasErrors(['title']);

        $this->assertEquals(1, App\Models\Profession::count());
    }

    /** @test */
    function the_field_title_must_be_unique_when_updating()
    {
        $this->create(App\Models\Profession::class, [
            'title' => 'PROFESION 1'
        ]);

        $profession = $this->create(App\Models\Profession::class, [
            'title' => 'PROFESION 2'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('professions.edit', $profession))
            ->put(route('professions.update', $profession), [
                'title' => 'PROFESION 1'
            ])
            ->assertRedirect(route('professions.edit', $profession))
            ->assertSessionHasErrors(['title']);
    }
}
