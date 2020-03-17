<?php

namespace Tests\Unit;

use Tests\{TestCase, TestHelpers};
use App\{EmployeeProfile, Position};
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class SixthDayWorkedTest extends TestCase
{
    use RefreshDatabase;

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
    function puede_calcular_la_prima_por_el_sexto_dia_trabajado_a_SB()
    {
        $this->employee->setSixthDayWorked(1);
        $this->assertEquals(2602.50, $this->employee->sixthDayWorkedPremium());
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_diurno()
    {
        $this->employee->setSixthDayWorkedDay(1);

        $sixthDayWorkedDay = number_format(
            $this->employee->sixthDayWorkedDay(1), 2, ',', '.');

        $this->assertEquals('1.735,00', $sixthDayWorkedDay);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_mixto()
    {
        $this->employee->setSixthDayWorkedMixed(1);

        $sixthDayWorkedMixed = number_format(
            $this->employee->sixthDayWorkedMixed(1), 2, ',', '.');

        $this->assertEquals('1.735,00', $sixthDayWorkedMixed);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_nocturno()
    {
        $this->employee->setSixthDayWorkedNigth(1);

        $sixthDayWorkedNigth = number_format(
            $this->employee->sixthDayWorkedNigth(1), 2, ',', '.');

        $this->assertEquals('1.735,00', $sixthDayWorkedNigth);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_prima_de_sexto_dia_trabajado()
    {
        $this->prepareParams();

        $salaryNormal = number_format(
            $this->employee->normalSalaryBonusSixthDayWorked(), 2, ',', '.');

        $this->assertEquals('4.089,58', $salaryNormal);
    }
}
