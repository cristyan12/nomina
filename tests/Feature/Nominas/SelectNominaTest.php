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
        $unit = $this->create(Unit::class);
        $nomina = $this->create(Nomina::class, ['name' => 'Nómina Semanal']);
        factory(EmployeeProfile::class, 5)->create([
            'unit_id' => $unit->id,
            'nomina_id' => $nomina->id,
        ]);

        $response = $this->get(route('nomina.selected', $nomina))
            ->assertSuccessful()
            ->assertViewIs('nomina.selected')
            ->assertViewHas('nomina', function($view) use ($nomina) {
                return $view->id === $nomina->id;
            });

        // HasMany
        $employees = Nomina::first()->employeeProfiles;

        foreach ($employees as $employee) {
            $response->assertSee(e($employee->code))
                ->assertSee(e($employee->full_name));
        }
    }
}
