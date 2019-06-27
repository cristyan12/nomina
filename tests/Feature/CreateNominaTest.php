<?php

namespace Tests\Feature;

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
    		'periods' => '52',
    		'first_period_at' => '2019-01-01',
    	])
    	->assertRedirect(route('nomina.index'));

    	$this->assertDatabaseHas('nominas', [
    		'name' => 'Nomina Semanal',
    		'type' => 'Semanal',
    		'periods' => '52',
    		'first_period_at' => '2019-01-01',
    	]);
    }
}
