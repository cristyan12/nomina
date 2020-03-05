<?php

namespace Tests\Unit\SistemasTrabajo;

use App\{EmployeeProfile, Position};
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};
use Tests\TestCase;

class CalculatePayTest extends TestCase
{
    use RefreshDatabase;

    protected $position;
    protected $employee;

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
        $this->employee->setDayWorkedDays(2);

        $this->assertEquals($this->employee->dayWorkedDays(), 3470.00);
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
        $this->assertSame($this->employee->sixthDayWorked(), 1735.00);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_diurno_a_52_por_ciento()
    {
        $travelTime = $this->employee
            ->setHoursDayTravelTime52(3)
            ->dayTravelTime52();

        $this->assertSame($travelTime, 988.95);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_mixto_a_52_por_ciento()
    {
        $travelTime = $this->employee
            ->setHoursMixedTravelTime52(3)
            ->mixedTravelTime52();

        $this->assertSame($travelTime, 1054.88);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_nocturno_a_52_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursNigthTravelTime52(6)
            ->nigthTravelTime52(), 2, ',', '.');

        $this->assertSame($travelTime, '2.260,46');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_diurno_a_77_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursDayTravelTime77(3)
            ->dayTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '1.151,61');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_mixto_a_77_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursMixedTravelTime77(3)
            ->mixedTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '1.228,38');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_nocturno_a_77_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursNigthTravelTime77(6)
            ->nigthTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '2.632,24');
    }

    /** @test */
    function puede_calcular_el_bono_por_tiempo_de_viaje_nocturno()
    {
        $bonus = $this->employee->setDayWorkedDays(2)
            ->setMixedWorkedDays(2)
            ->setNightWorkedDays(4)
            ->hoursBonusTravelTimeNight();

        $bonusTravelTimeNight = number_format($this->employee->bonusTravelTimeNight(), 2, ',', '.');

        $this->assertEquals('824,13', $bonusTravelTimeNight);
    }

    /** @test */
    function puede_calcular_la_prima_por_trabajo_en_dia_domingo_a_SB()
    {
        $this->assertEquals(2602.50, $this->employee->sundayPremium());
    }

    /** @test */
    function puede_calcular_la_prima_por_el_sexto_dia_trabajado_a_SB()
    {
        $this->assertEquals(2602.50, $this->employee->sixthDayWorkedPremium());
    }

    /** @test */
    function puede_calcular_el_bono_nocturno_a_SB()
    {
        $this->employee->setNightWorkedDays(4)
            ->setMixedWorkedDays(2)
            ->hoursForNigthBonus();

        $this->assertEquals('2.637,20', number_format($this->employee->nightBonus(), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_mixto_a_SB()
    {
        $this->employee->setMixedWorkedDays(2)
            ->setSixthDayWorkedMixed(0);

        $TEGMxto = number_format($this->employee->mixedWatchExtraTime(), 2, ',', '.');

        $this->assertEquals('418,71', $TEGMxto);
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_nocturno_a_SB()
    {
        $this->employee->setNightWorkedDays(4);

        $TEGMxto = number_format($this->employee->nigthWatchExtraTime(), 2, ',', '.');

        $this->assertEquals('1.794,49', $TEGMxto);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_diurno()
    {
        $this->employee->setSixthDayWorkedDay(1);

        $sixthDayWorkedDay = number_format($this->employee->sixthDayWorkedDay(1), 2, ',', '.');

        $this->assertEquals('1.735,00', $sixthDayWorkedDay);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_mixto()
    {
        $this->employee->setSixthDayWorkedMixed(1);

        $sixthDayWorkedMixed = number_format($this->employee->sixthDayWorkedMixed(1), 2, ',', '.');

        $this->assertEquals('1.735,00', $sixthDayWorkedMixed);
    }

    /** @test */
    function puede_calcular_el_sexto_dia_trabajado_nocturno()
    {
        $this->employee->setSixthDayWorkedNigth(1);

        $sixthDayWorkedNigth = number_format($this->employee->sixthDayWorkedNigth(1), 2, ',', '.');

        $this->assertEquals('1.735,00', $sixthDayWorkedNigth);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_prima_de_sexto_dia_trabajado()
    {
        $this->prepareParams();

        $salaryNormal = number_format($this->employee->normalSalaryBonusSixthDayWorked(), 2, ',', '.');

        $this->assertEquals('3.934,19', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_descanso_0039()
    {
        $this->prepareParams();

        $salaryNormal = number_format($this->employee->normalSalaryForRest(), 2, ',', '.');

        $this->assertEquals('4.259,51', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_bono_nocturno_0002()
    {
        $this->prepareParams();

        $salaryNormal = number_format($this->employee->normalSalaryForNigthBonus(), 2, ',', '.');

        $this->assertEquals('3.929,86', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_prima_dominical_0038()
    {
        $this->prepareParams();

        $salaryNormal = number_format($this->employee->normalSalaryForSundayPremium(), 2, ',', '.');

        $this->assertEquals('3.934,19', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_0001()
    {
        $this->prepareParams();

        $salaryNormal = number_format($this->employee->normalSalary(), 2, ',', '.');

        $this->assertEquals('3.982,86', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_mixto_a_SN()
    {
        $this->prepareParams();

        $this->assertEquals('881,54', number_format($this->employee->mixedWatchExtraTimeSN(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_nocturno_a_SN()
    {
        $this->prepareParams();

        $this->assertEquals('3.778,02', number_format($this->employee->nightWatchExtraTimeSN(4), 2, ',', '.'));
    }

    protected function prepareParams()
    {
        $days = $this->employee->setDayWorkedDays(2)
            ->setMixedWorkedDays(2)
            ->setNightWorkedDays(4);

        $travelTime = $this->employee
            ->setHoursDayTravelTime52(3)
            ->setHoursDayTravelTime77(3)
            ->setHoursMixedTravelTime52(3)
            ->setHoursMixedTravelTime77(3)
            ->setHoursNigthTravelTime52(6)
            ->setHoursNigthTravelTime77(6);

        $nightBonus = $this->employee->hoursBonusTravelTimeNight()
            ->hoursForNigthBonus();
    }
}