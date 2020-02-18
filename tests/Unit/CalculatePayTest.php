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
    use DatabaseTransactions;

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

    /** @test */
    function it_calculate_bonus_per_worked_in_sunday()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);
        $employee->setDaysWorked(5)
            ->setPercentTravelTime('52')
            ->setHoursTravelTime(3);

        $this->assertEquals($employee->workedInSunday(), 4065.84);
    }
}
