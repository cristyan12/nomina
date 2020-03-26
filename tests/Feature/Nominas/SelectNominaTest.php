<?php

namespace Tests\Feature\Nominas;

use App\{EmployeeProfile, Nomina, Unit};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SelectNominaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($user = $this->someUser());

        $this->withoutExceptionHandling();
    }

    /** @test */
    function un_usuario_puede_seleccionar_la_nomina()
    {
        $nomina = $this->create(Nomina::class);
        $unit = $this->create(Unit::class);
        $employees = factory(EmployeeProfile::class, 5)->create([
            'unit_id' => $unit->id,
            'nomina_id' => $nomina->id,
        ]);

        $this->assertEquals(5, EmployeeProfile::count());

        $response = $this->get(route('nomina.selected', $nomina))
            ->assertSuccessful()
            ->assertViewIs('nomina.selected')
            ->assertViewHas('unit')
            ->assertViewHas('nomina', function($view) use ($nomina) {
                return $view->id === $nomina->id;
            })
            ->assertSee($nomina->name)
            ->assertSee('Lista de trabajadores de '.$unit->name);

            foreach ($employees as $emp) {
                $response->assertSee($emp->full_name)
                    ->assertSee($emp->document);
            }
    }
}
