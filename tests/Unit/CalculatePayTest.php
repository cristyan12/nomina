<?php

namespace Tests\Unit;

use App\{
    Employee, Position, EmployeeProfile
};
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
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

        $payByHour = $position->getHoursSalary();

        $this->assertEquals('712,28', $payByHour);
    }
}
