<?php

namespace Tests\Unit\SistemasTrabajo;

use App\{EmployeeProfile, Position};
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};
use Tests\TestCase;

class CalculatePayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function puede_calcular_los_dias_trabajados()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
       $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $days = $employee->setDaysWorked(5)->daysWorked();

        $this->assertEquals($days, 8675.00);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_programado()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertSame($employee->sixthDayWorked(), 1735.00);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_diurno_a_52_por_ciento()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = $employee
            ->setHoursDayTravelTime52(3)
            ->dayTravelTime52();

        $this->assertSame($travelTime, 988.95);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_mixto_a_52_por_ciento()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = $employee
            ->setHoursMixedTravelTime52(3)
            ->mixedTravelTime52();

        $this->assertSame($travelTime, 1054.88);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_nocturno_a_52_por_ciento()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = number_format($employee
            ->setHoursNigthTravelTime52(6)
            ->nigthTravelTime52(), 2, ',', '.');

        $this->assertSame($travelTime, '2.260,46');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_diurno_a_77_por_ciento()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = number_format($employee
            ->setHoursDayTravelTime77(3)
            ->dayTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '1.151,61');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_mixto_a_77_por_ciento()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = number_format($employee
            ->setHoursMixedTravelTime77(3)
            ->mixedTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '1.228,38');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_nocturno_a_77_por_ciento()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = number_format($employee
            ->setHoursNigthTravelTime77(6)
            ->nigthTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '2.632,24');
    }

    /** @test */
    function puede_calcular_el_bono_por_tiempo_de_viaje_nocturno()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $bonus = $employee->setDaysWorkedDay(2)
            ->setNightWorkedDays(4)
            ->getHoursBonusTravelTimeNight();

        $bonusTravelTimeNight = number_format($employee->bonusTravelTimeNight(), 2, ',', '.');

        $this->assertEquals('576,89', $bonusTravelTimeNight);
    }

    /** @test */
    function puede_calcular_la_prima_por_trabajo_en_dia_domingo_a_SB()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertEquals(2602.50, $employee->sundayPremium());
    }

    /** @test */
    function puede_calcular_la_prima_por_el_sexto_dia_trabajado_a_SB()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertEquals(2602.50, $employee->sixthDayWorkedPremium());
    }

    /** @test */
    function puede_calcular_el_bono_nocturno_a_SB()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $employee->setNightWorkedDays(4)
            ->hoursForNigthBonus();

        $this->assertEquals(1977.90, $employee->nightBonus());
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_mixto()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $employee->setMixedDaysWorked(2)
            ->setSixthDayWorkedMixed(0);

        $TEGMxto = number_format($employee->mixedWatchExtraTime(), 2, ',', '.');

        $this->assertEquals('418,71', $TEGMxto);
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_nocturno()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $employee->setNightWorkedDays(4);

        $TEGMxto = number_format($employee->nigthWatchExtraTime(), 2, ',', '.');

        $this->assertEquals('1.794,49', $TEGMxto);
    }
}
