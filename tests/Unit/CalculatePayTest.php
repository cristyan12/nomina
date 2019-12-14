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

        $this->assertEquals(216.875, $payByHour);
    }

    /**
     * @test
     * @testdox Puede calcular el salario base mensual
     */
    function it_can_calculate_the_basic_salary_monthly()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $monthlySalary = $employee->getMonthlySalary();

        $this->assertEquals(52050.00, $monthlySalary);
    }

    /**
     * @test
     * @testdox Puede calcular el pago por los dias trabajados diurnos
     */
    function it_can_calculate_the_pay_for_diary_worked_days()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payDiurnalWorkedDays = $employee->payWorkedDays(2);

        $this->assertEquals('3.470,00', $payDiurnalWorkedDays);
    }

    /**
     * @test
     * @testdox Puede calcular el pago por los dias trabajados mixtos
     */
    function it_can_calculate_the_pay_for_mixed_worked_days()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payMixedWorkedDays = $employee->payWorkedDays(2);

        $this->assertEquals('3.470,00', $payMixedWorkedDays);
    }

    /**
     * @test
     * @testdox Puede calcular el pago por los dias trabajados nocturnos
     */
    function it_can_calculate_the_pay_for_nighlty_worked_days()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payNightlyWorkedDays = $employee->payWorkedDays(4);

        $this->assertEquals('6.940,00', $payNightlyWorkedDays);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada diaria
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_diary_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $employee->payExtraHours(15, 'diaria');

        $this->assertEquals('6.278,53', $payByExtraHours);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada mixta
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_mixed_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $employee->payExtraHours(15, 'mixta');

        $this->assertEquals('6.280,70', $payByExtraHours);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada nocturna
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_nightly_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $employee->payExtraHours(15, 'nocturna');

        $this->assertEquals('6.729,32', $payByExtraHours);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje 52%
     */
    function it_can_calculate_the_pay_for_travel_time_diary_52_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $employee->payTravelTime(3, 'diaria', 'diaria52');

        $this->assertEquals('988,95', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje 77%
     */
    function it_can_calculate_the_pay_for_travel_time_diary_77_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $employee->payTravelTime(3, 'diaria', 'diaria77');

        $this->assertEquals('1.151,61', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje mixto 52%
     */
    function it_can_calculate_the_pay_for_travel_time_mixed_52_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $employee->payTravelTime(3, 'mixta', 'mixta52');

        $this->assertEquals('1.054,88', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje mixto 77%
     */
    function it_can_calculate_the_pay_for_travel_time_mixed_77_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $employee->payTravelTime(3, 'mixta', 'mixta77');

        $this->assertEquals('1.228,38', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje nocturna 52%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_52_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $employee->payTravelTime(6, 'nocturna', 'nocturna52');

        $this->assertEquals('2.260,46', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje nocturno 77%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_77_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $employee->payTravelTime(6, 'nocturna', 'nocturna77');

        $this->assertEquals('2.632,24', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Calcula el pago por sexto dia trabajado
     */
    function it_can_calculate_the_pay_for_work_in_sixth_day_worked()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $paySixthDayWorked = $employee->paySixthDayWorked(1);

        $this->assertEquals('1.735,00', $paySixthDayWorked);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Bono por Tiempo de Viaje nocturno 38%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_of_3_50_hours()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTimeNightly = $empProfile->payTravelTimeNightly(3.50);

        $this->assertEquals('288,44', $payByTravelTimeNightly);
    }
}
