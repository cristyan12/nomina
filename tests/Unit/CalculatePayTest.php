<?php

namespace Tests\Unit\SistemasTrabajo;

use App\{
    EmployeeProfile, Position
};
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};
use Tests\TestCase;

class CalculatePayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_calculate_5_days_worked()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $days = $employee->setDaysWorked(5)->daysWorked();

        $this->assertEquals($days, 8675.00);
    }

    /** @test */
    function it_calculate_the_programed_sixth_day_worked()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertSame($employee->sixthDayWorked(), 1735.00);
    }

    /**
     * @test
     * @testdox Puede calcular el tiempo de viaje de de 1.5 hrs a 52% Diurno
     */
    function puede_calcular_3_horas_de_tiempo_de_viaje_diurno_a_52p()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = $employee
            ->setPercentTravelTime('52')
            ->setHoursTravelTime(3)
            ->travelTime();

        $this->assertSame($travelTime, 988.95);
    }

    /** @test */
    function puede_calcular_3_horas_de_tiempo_de_viaje_mixto_a_52p()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $journalMixed = 7.5;
        $travelTime = $employee
            ->setPercentTravelTime('52')
            ->setHoursTravelTime(3)
            ->travelTime($journalMixed);

        $this->assertSame($travelTime, 1054.88);
    }

    /** @test */
    function puede_calcular_6_horas_de_tiempo_de_viaje_nocturno_a_52p()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $journalMixed = 7;
        $travelTime = number_format($employee
            ->setPercentTravelTime('52')
            ->setHoursTravelTime(6)
            ->travelTime($journalMixed), 2, ',', '.');

        $this->assertSame($travelTime, '2.260,46');
    }

    /** @test */
    function puede_calcular_3_horas_de_tiempo_de_viaje_diurno_a_77p()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = number_format($employee
            ->setPercentTravelTime('77')
            ->setHoursTravelTime(3)
            ->travelTime(), 2, ',', '.');

        $this->assertSame($travelTime, '1.151,61');
    }

    /** @test */
    function puede_calcular_3_horas_de_tiempo_de_viaje_mixto_a_77p()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $journalHours = 7.5;
        $travelTime = number_format($employee
            ->setPercentTravelTime('77')
            ->setHoursTravelTime(3)
            ->travelTime($journalHours), 2, ',', '.');

        $this->assertSame($travelTime, '1.228,38');
    }

    /** @test */
    function puede_calcular_6_horas_de_tiempo_de_viaje_nocturno_a_77p()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $journalHours = 7;
        $travelTime = number_format($employee
            ->setPercentTravelTime('77')
            ->setHoursTravelTime(6)
            ->travelTime($journalHours), 2, ',', '.');

        $this->assertSame($travelTime, '2.632,24');
    }

    /** @test */
    function it_calculate_bonus_for_travel_time_night()
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
    function it_calcultate_the_sunday_premium_to_basic_salary()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertEquals(2602.50, $employee->sundayPremium());
    }

    /** @test */
    function it_calcultate_the_sixth_day_worked_premium_to_basic_salary()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertEquals(2602.50, $employee->sixthDayWorkedPremium());
    }

    /** @test */
    function it_calcultate_the_bonus_nigth_to_basic_salary()
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

    /** @test */
    function it_calculate_bonus_per_worked_in_sunday()
    {
        $this->markTestIncomplete();
        return;

        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $days = $employee->setDaysWorked(5)
            ->setMixedDaysWorked()
            ->setDaysWorkedDay()
            ->setNightWorkedDays();

        $travelTimeDiurno52 = $employee
            ->setPercentTravelTime('52')
            ->setHoursTravelTime(3)
            ->travelTime();

        $travelTimeDiurno77 = $employee
            ->setPercentTravelTime('77')
            ->setHoursTravelTime(3)
            ->travelTime();

        $travelTimeNocturno52 = $employee
            ->setPercentTravelTime('52')
            ->setHoursTravelTime(6)
            ->travelTime();

        $travelTimeNocturno77 = $employee
            ->setPercentTravelTime('77')
            ->setHoursTravelTime(6)
            ->travelTime();


        $this->assertEquals($employee->bonusWorkedInSunday(), 4065.84);
    }
}
