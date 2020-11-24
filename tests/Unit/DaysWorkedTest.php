<?php

namespace Tests\Unit;

use Tests\{TestCase, TestHelpers};
use App\Models\{EmployeeProfile, Position};
use Illuminate\Foundation\Testing\RefreshDatabase;

class DaysWorkedTest extends TestCase
{
    use RefreshDatabase;

    private $position;
    private $employee;

    public function setUp(): void
    {
        parent::setUp();

        $this->position = $this->create(Position::class, [
            'basic_salary' => 1735.00
        ]);

        $this->employee = $this->create(EmployeeProfile::class, [
            'position_id' => $this->position->id
        ]);
    }

    /** @test */
    function puede_calcular_los_dias_trabajados()
    {
        $days = $this->employee->setDaysWorked(5)->daysWorked();

        $this->assertEquals($days, 8675.00);
    }

    /** @test */
    function puede_calcular_los_dias_trabajados_diurnos()
    {
        $this->employee->setDayWorkedDays(1);

        $this->assertEquals($this->employee->dayWorkedDays(), 1735);
    }

    /** @test */
    function puede_calcular_los_dias_trabajados_mixtos()
    {
        $this->employee->setMixedWorkedDays(2);

        $this->assertEquals($this->employee->mixedWorkedDays(), 3470.00);
    }

    /** @test */
    function puede_calcular_los_dias_trabajados_nocturnos()
    {
        $this->employee->setNightWorkedDays(4);

        $this->assertEquals($this->employee->nightWorkedDays(), 6940.00);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_programado()
    {
        $this->employee->setSixthDayWorked(1);
        $this->assertSame($this->employee->sixthDayWorked(), 1735.00);
    }
}
