<?php

namespace Tests\Feature\Nominas;

use App\Nomina;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class UpdateNominaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($this->someUser());

        // $this->withoutExceptionHandling();
    }

    /**
     *  @test
     *  @testdox Un usuario puede cargar la página de edición de nominas
    */
    function a_user_can_loads_the_edit_page()
    {
        $nomina = $this->create('App\Nomina');

        $response = $this->get(route('nomina.edit', $nomina->id))
            ->assertOk()
            ->assertViewis('nomina.edit')
            ->assertSee('Editar nómina')
            // ->assertViewHas('nomina', fn($viewNomina) => $viewNomina->id === $nomina->id); +PHP 7.4
            ->assertViewHas('nomina', function ($viewNomina) use ($nomina) {
                return $viewNomina->id === $nomina->id;
            });
    }

    /**
     *  @test
     *  @testdox Un usuario puede actualizar un registro de nomina
    */
    function a_user_can_update_a_nomina()
    {
        $this->withoutExceptionHandling();

        $user = $this->someUser();
        $nomina = $this->create('App\Nomina');

        $response = $this->actingAs($user)
            ->put(route('nomina.update', $nomina->id), [
                'name' => 'Quincenal',
                'type' => 'Quincenal',
                'periods' => '24',
                'first_period_at' => '2020-01-01',
                'last_period_at' => '2021-01-01',
            ])
        ->assertRedirect(route('nomina.index'));

        $nomina = Nomina::first();
        $this->assertSame('Quincenal', $nomina->name);
        $this->assertSame('Quincenal', $nomina->type);
        $this->assertSame('24', $nomina->periods);
        $this->assertSame('2020-01-01', $nomina->first_period_at->toDateString());
        $this->assertSame('2021-01-01', $nomina->last_period_at->toDateString());
        $this->assertEquals($user->id, $nomina->user_id);
    }

    /**
     *  @test
     *  @testdox El campo "nombre" es obligatorio cuando se actualiza
    */
    function field_name_must_require_when_updating()
    {
        $nomina = $this->create('App\Nomina');

        $response = $this->from(route('nomina.edit', $nomina->id))
            ->put(route('nomina.update', $nomina->id), [
                'name' => '',
                'type' => 'Semanal',
            ])
            ->assertRedirect(route('nomina.edit', $nomina->id))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Nomina::count());
    }

    /**
     *  @test
     *  @testdox El campo "nombre" debe ser único en la tabla de nominas cuando se actualiza
    */
    function field_name_must_be_unique_when_updating()
    {
        $this->create('App\Nomina', [
            'name' => 'NOMBRE INICIAL',
        ]);

        $nomina = $this->create('App\Nomina', [
            'name' => 'OTRO NOMBRE',
        ]);

        $response = $this->from(route('nomina.edit', $nomina->id))
            ->put(route('nomina.update', $nomina->id), [
                'name' => 'NOMBRE INICIAL',
                'type' => 'Semanal',
            ])
            ->assertRedirect(route('nomina.edit', $nomina->id))
            ->assertSessionHasErrors(['name']);

        $nomina = Nomina::find($nomina->id);
        $this->assertSame('OTRO NOMBRE', $nomina->name);
    }

    /**
     *  @test
     *  @testdox El campo "tipo" es obligatorio cuando se actualiza
    */
    function field_type_must_require_when_updating()
    {
        $nomina = $this->create('App\Nomina');

        $response = $this->from(route('nomina.edit', $nomina->id))
            ->put(route('nomina.update', $nomina->id), [
                'name' => 'NOMINA',
                'type' => '',
            ])
            ->assertRedirect(route('nomina.edit', $nomina->id))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(1, Nomina::count());
    }
}
