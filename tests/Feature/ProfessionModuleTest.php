<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessionModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_new_profession_page()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('professions.create'))
            ->assertStatus(200)
            ->assertViewIs('professions.create')
            ->assertSee('Profesiones');
    }

    /** @test */
    function a_user_can_create_a_new_profession()
    {
        $this->withoutExceptionHandling();

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
        $professions = factory(App\Profession::class, 10)->create();

        $response = $this->actingAs($this->someUser())
            ->get(route('professions.index'))
            ->aseertViewIs('professions.index')
            ->assertViewHas('professions');

        foreach ($professions as $profession) {
            $response->assertSee(e($profession->title));
        }
    }

    /** @test */
    function the_field_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs($this->someUser())
            ->from(route('professions.index'))
            ->post(route('professions.store'), [
                'title' => ''
            ])
            ->assertRedirect(route('professions.store'))
            ->assertSessionHasErrors(['title']);

        $this->assertEquals(0, \App\Profession::count());
    }
}
