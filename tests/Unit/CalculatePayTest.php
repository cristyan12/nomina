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

    /**
     * @test
     * @testdox Puede calcular el salario base por hora en jornada diaria de 8 horas
     */
    function it_can_calculate_the_basic_salary_by_hour_in_diary_journal_of_eight_hours()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByHour = $position->getSalaryByHours(8);

        $this->assertEquals(216.88, $payByHour);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada diaria
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_diary_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'diaria');

        $this->assertEquals('3.025,48', $payByExtraHours);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada mixta
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_mixed_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'mixta');

        $this->assertEquals('2.810,66', $payByExtraHours);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada nocturna
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_nightly_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'nocturna');

        $this->assertEquals('3.011,50', $payByExtraHours);
    }
}
