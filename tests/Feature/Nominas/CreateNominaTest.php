<?php

namespace Tests\Feature;

use App\Nomina;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class CreateNominaTest extends TestCase
{
	use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($user = $this->someUser());

        // $this->withoutExceptionHandling();
    }

    /**
     *  @test
     *  @testdox Un usuario puede cargar la página de creación de una nomina
    */
    function a_user_can_load_the_page_of_create_nomina()
    {
    	$response = $this->get(route('nomina.create'))
    		->assertOk()
    		->assertViewIs('nomina.create')
    		->assertSee('Crear nómina');
    }

    /**
     *  @test
     *  @testdox Un usuario puede crear una nomina
    */
    function a_user_can_create_a_nomina()
    {
        $this->actingAs($user = $this->someUser());

    	$response = $this->post(route('nomina.store'), [
    		'name' => 'Nomina Semanal',
    		'type' => 'Semanal',
            'periods' => '52',
            'first_period_at' => '2019-01-01',
            'last_period_at' => '2020-01-01',
    	])
    	->assertRedirect(route('nomina.index'));

        $nomina = Nomina::first();
        $this->assertSame('Nomina Semanal', $nomina->name);
        $this->assertSame('Semanal', $nomina->type);
        $this->assertSame('52', $nomina->periods);
        $this->assertSame('2019-01-01', $nomina->first_period_at->toDateString());
        $this->assertSame('2020-01-01', $nomina->last_period_at->toDateString());
        $this->assertEquals($user->id, $nomina->user_id);
    }

    /**
     *  @test
     *  @testdox El campo "nombre" es obligatorio
    */
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

    /**
     *  @test
     *  @testdox El campo "nombre" debe ser único en la tabla de nominas
    */
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

    /**
     *  @test
     *  @testdox El campo "tipo" es obligatorio
    */
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

    /**
     *  @test
     *  @testdox El campo "períodos" puede ser opcional o null
    */
    function field_periods_can_be_optional()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'periods' => '',
            ]);

        $nomina = Nomina::first();
        $this->assertNull($nomina->periods);
    }

    /**
     *  @test
     *  @testdox El campo "fecha del primer período" debe ser una fecha válida
    */
    function field_first_period_at_must_be_a_valid_date()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'first_period_at' => 'FECHANOVALIDA',
            ])
            ->assertRedirect('nominas/create')
            ->assertSessionHasErrors(['first_period_at']);

        $this->assertEquals(0, Nomina::count());
    }

    /**
     *  @test
     *  @testdox El campo "fecha del primer período" puede ser opcional o null
    */
    function field_first_period_at_can_be_optional()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'first_period_at' => null,
            ]);

        $nomina = Nomina::first();
        $this->assertNull($nomina->first_period_at);
    }

    /**
     *  @test
     *  @testdox El campo "fecha del último período" debe ser una fecha válida
    */
    function field_last_period_at_must_be_a_valid_date()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'last_period_at' => 'FECHANOVALIDA',
            ])
            ->assertRedirect('nominas/create')
            ->assertSessionHasErrors(['last_period_at']);

        $this->assertEquals(0, Nomina::count());
    }

    /**
     *  @test
     *  @testdox El campo "fecha del último período" debe ser una fecha diferente a la fecha del primer período
    */
    function field_last_period_at_must_be_diferent_date_of_first_period()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'first_period_at' => '2019-01-01',
                'last_period_at' => '2019-01-01',
            ])
            ->assertRedirect('nominas/create')
            ->assertSessionHasErrors(['last_period_at']);

        $this->assertEquals(0, Nomina::count());
    }

    /**
     *  @test
     *  @testdox El campo "fecha del último período" debe ser una fecha posterior a la fecha del primer período
    */
    function field_last_period_at_must_be_after_date_of_first_period()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'first_period_at' => '2019-01-01',
                'last_period_at' => '2018-01-01',
            ])
            ->assertRedirect('nominas/create')
            ->assertSessionHasErrors(['last_period_at']);

        $this->assertEquals(0, Nomina::count());
    }

    /**
     *  @test
     *  @testdox El campo "fecha del último período" puede ser opcional o null
    */
    function field_last_period_at_can_be_optional()
    {
        $response = $this->from('nominas/create')
            ->post(route('nomina.store'), [
                'name' => 'Nomina X',
                'type' => 'Mensual',
                'last_period_at' => '',
            ]);

        $nomina = Nomina::first();
        $this->assertNull($nomina->last_period_at);
    }
}
