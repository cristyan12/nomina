<?php

namespace Tests\Feature;

use App\Nomina;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateNominaTest extends TestCase
{
	use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->be($this->someUser());
    }

	/** @test */
    function it_load_the_page_of_create_nomina()
    {
    	$response = $this->get(route('nomina.create'))
    		->assertOk()
    		->assertViewIs('nomina.create')
    		->assertSee('Crear nómina');
    }

    /** @test */
    function a_user_can_create_a_nomina()
    {
    	$response = $this->post(route('nomina.store'), [
    		'name' => 'Nomina Semanal',
    		'type' => 'Semanal',
            'periods' => '52',
            'first_period' => '2019-01-01',
    	])
    	->assertRedirect(route('nomina.index'));

    	$this->assertDatabaseHas('nominas', [
    		'name' => 'Nomina Semanal',
    		'type' => 'Semanal',
            'periods' => '52',
            'first_period' => '2019-01-01',
    	]);
    }

    /** @test */
    function field_name_must_require()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => '',
                'type' => 'Semanal',
            ])
            ->assertRedirect(route('nomina.create'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Nomina::count());
    }

    /** @test */
    function field_name_must_be_unique()
    {
        $nomina = $this->create('App\Nomina', [
            'name' => 'NOMINA 1',
        ]);

        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'NOMINA 1',
                'type' => 'Semanal',
            ])
            ->assertRedirect(route('nomina.create'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Nomina::count());
    }

    /** @test */
    function field_type_must_require()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => '',
            ])
            ->assertRedirect(route('nomina.create'))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(0, Nomina::count());
    }

    /** @test */
    function a_user_can_loads_the_edit_page()
    {
        $nomina = $this->create('App\Nomina');

        $response = $this->get(route('nomina.edit', $nomina->id))
            ->assertOk()
            ->assertViewis('nomina.edit')
            ->assertSee('Editar nómina')
            ->assertViewHas('nomina', function ($viewNomina) use ($nomina) {
                return $viewNomina->id === $nomina->id;
            });
    }

    /** @test */
    function a_user_can_update_a_nomina()
    {
        $nomina = $this->create('App\Nomina');

        $response = $this->put(route('nomina.update', $nomina->id), [
            'name' => 'Quincenal',
            'type' => 'Quincenal',
            'periods' => '24',
            'first_period' => '2020-01-01',
        ])
        ->assertRedirect(route('nomina.index'));

        $this->assertDatabaseHas('nominas', [
            'name' => 'Quincenal',
            'type' => 'Quincenal',
        ]);
    }

    // TODO: Refactorizar el código de la actualización
}
