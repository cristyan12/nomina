<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\{
    DatabaseTransactions,
    RefreshDatabase
};
use Tests\TestCase;

class CalculatePayTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_can_calculate_the_pay_for_hours()
    {
        $position = $this->create('App\Position', ['basic_salary' => '5698.23']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByHour = $position->getHoursBySalary();

        $this->assertEquals(712.28, $payByHour);
    }

    /** @test */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week()
    {
        $position = $this->create('App\Position', ['basic_salary' => '5698.23']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payByExtraHoursDay(15);

        $this->assertSame('9.936,31', $payByExtraHours);
    }
}
