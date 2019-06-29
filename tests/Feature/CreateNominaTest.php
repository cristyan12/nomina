<?php

namespace Tests\Feature;

use App\Nomina;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNominaTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
    function it_load_the_page_of_create_nomina()
    {
    	$response = $this->get(route('nomina.create'))
    		->assertOk()
    		->assertViewIs('nomina.create')
    		->assertSee('Crear nomina');
    }

    /** @test */
    function a_user_can_create_a_nomina()
    {
    	$this->be($this->someUser());

    	$response = $this->post(route('nomina.store'), [
    		'name' => 'Nomina Semanal',
    		'type' => 'Semanal',
    	])
    	->assertRedirect(route('nomina.index'));

    	$this->assertDatabaseHas('nominas', [
    		'name' => 'Nomina Semanal',
    		'type' => 'Semanal',
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
}
