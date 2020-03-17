<?php

namespace Tests\Feature\Nominas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectNominaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($user = $this->someUser());

        // $this->withoutExceptionHandling();
    }

    /** @test */
    function un_usuario_puede_seleccionar_la_nomina()
    {
       $nomina = $this->create('App\Nomina', [
            'name' => 'Nómina Semanal',
        ]);

        $response = $this->get(route('nomina.select', $nomina))
            ->assertOk()
            ->assertViewIs('nomina.select')
            ->assertViewHas('nominas')
            ->assertSee('Nómina Semanal');

        // TODO: Cuando seleccione la nomina,
        //      debe verse en pantalla el listado de trabajadores
        //      filtrado por el lugar de trabajo
    }
}
