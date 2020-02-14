<?php

namespace Tests\Unit\SistemasTrabajo;

use App\EmployeeProfile;
use App\Position;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Daily5556Test extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_calculate_5_days_worked()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertSame($employee->daysWorked(5), 8675.00);
    }

    /** @test */
    function it_calculate_the_programed_sixth_day_worked()
    {
        $position = $this->create(Position::class, ['basic_salary' => 1735.00]);
        $employee = $this->create(EmployeeProfile::class, ['position_id' => $position->id]);

        $this->assertSame($employee->sixthDayWorked(), 1735.00);
    }
}
