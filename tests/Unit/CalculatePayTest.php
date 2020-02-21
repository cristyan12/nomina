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

    /** @test */
    function it_calculate_the_travel_time_1_5_hours_for_3_hours_of_travel()
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
    function it_calculate_the_travel_time_more_than_1_5_hours_for_3_hours_of_travel()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $travelTime = $employee
            ->setPercentTravelTime('77')
            ->setHoursTravelTime(3)
            ->travelTime();

        $this->assertSame($travelTime, 1151.6062499999998);
    }

    // Bonif. por tiempo de viaje nocturno

    /** @test */
    function it_calculate_bonus_for_travel_time_night()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        // Son necesarios solo los valores mayores a cero
        $bonus = $employee->setDaysWorkedDay(2)
            ->setNightWorkedDays(4)
            ->getHoursBonusTravelTimeNight(); // Unidad de tiempo para Bono T.V. Nocturno

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

    // /** @test */
    // function it_calculate_bonus_per_worked_in_sunday()
    // {
    //     $this->markTestIncomplete();
    //     return;

    //     $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
    //     $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
    //     $employee->setDaysWorked(5)
    //         ->setPercentTravelTime('52')
    //         ->setHoursTravelTime(3);

    //     $this->assertEquals($employee->workedInSunday(), 4065.84);
    // }
}
