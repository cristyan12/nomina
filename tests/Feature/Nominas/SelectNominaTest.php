<?php

namespace Tests\Feature\Nominas;

use Tests\TestCase;
use App\{EmployeeProfile, Nomina, Unit};
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $nomina = $this->create(Nomina::class, ['name' => 'Nómina Semanal']);
        factory(EmployeeProfile::class, 5)->create([
            'nomina_id' => $nomina->id,
        ]);

        $response = $this->get(route('nomina.selected', $nomina))
            ->assertSuccessful()
            ->assertViewIs('nomina.selected')
            ->assertSee('Nómina Semanal')
            ->assertViewHas('nomina', function($view) use ($nomina) {
                return $view->id === $nomina->id;
            });

        $employees = Nomina::first()->profiles;

        foreach ($employees as $employee) {
            $response->assertSee(e($employee->code))
                ->assertSee(e($employee->full_name));
        }
    }
}
