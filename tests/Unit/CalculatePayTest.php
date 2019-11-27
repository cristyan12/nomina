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
    function it_can_calculate_the_pay_for_eight_hours()
    {
        $position = $this->create('App\Position', ['basic_salary' => '5698.23']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByHour = $position->getSalaryByHours(8);

        $this->assertEquals(712.28, $payByHour);
    }

    /** @test */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_diary_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '5698.23']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'diaria');

        $this->assertEquals('9.936,31', $payByExtraHours);
    }

    /** @test */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_mixed_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '5698.23']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'mixta');

        $this->assertEquals('9.231,08', $payByExtraHours);
    }

    /** @test */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_nightly_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '5698.23']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'nocturna');

        $this->assertEquals('9.890,46', $payByExtraHours);
    }
}
