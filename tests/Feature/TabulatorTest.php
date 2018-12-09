<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TabulatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_load_the_creation_of_tabulator_page()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('tabulator.create'))
            ->assertStatus(200)
            ->assertViewIs('tabulator.create')
            ->assertSee('Crear cargo');
    }

    /** @test */
    public function it_show_a_message_when_no_records_yet()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('tabulator.index'))
            ->assertStatus(200)
            ->assertViewIs('tabulator.index')
            ->assertSee('Tabulador de cargos CCP 2017-2019')
            ->assertSee('No hay cargos registrados aún.');
    }

    /** @test */
    public function a_user_can_create_a_new_position()
    {
        $this->withoutExceptionHandling();

        $user = $this->someUser();

        $response = $this->actingAs($user)
            ->post(route('tabulator.store'), [
                'code' => 'OPE01',
                'name' => 'PERFORADOR',
                'basic_salary' => '105324.30'
            ])->assertRedirect(route('tabulator.index'));

        $this->assertDatabaseHas('tabulators', [
            'code' => 'OPE01',
            'name' => 'PERFORADOR',
            'basic_salary' => '105324.30'
        ]);
    }
}
