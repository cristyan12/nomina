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
     * @testdox Puede calcular el pago de 15 horas extras semanales en una jornada diaria
     */
    function it_can_calculate_the_pay_for_15_extra_hours_by_week_in_diary_journal()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByExtraHours = $empProfile->payExtraHours(15, 'diaria');

        $this->assertEquals('6.278,53', $payByExtraHours);
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

        $this->assertEquals('6.280,70', $payByExtraHours);
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

        $this->assertEquals('6.729,32', $payByExtraHours);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje 52%
     */
    function it_can_calculate_the_pay_for_travel_time_diary_52_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $empProfile->payTravelTime(3, 'diaria', 'diaria52');

        $this->assertEquals('988,95', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje 77%
     */
    function it_can_calculate_the_pay_for_travel_time_diary_77_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $empProfile->payTravelTime(3, 'diaria', 'diaria77');

        $this->assertEquals('1.151,61', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje mixto 52%
     */
    function it_can_calculate_the_pay_for_travel_time_mixed_52_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $empProfile->payTravelTime(3, 'mixta', 'mixta52');

        $this->assertEquals('1.054,88', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje mixto 77%
     */
    function it_can_calculate_the_pay_for_travel_time_mixed_77_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $empProfile->payTravelTime(3, 'mixta', 'mixta77');

        $this->assertEquals('1.228,38', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje nocturna 52%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_52_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $empProfile->payTravelTime(6, 'nocturna', 'nocturna52');

        $this->assertEquals('2.260,46', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Puede calcular el pago de Tiempo de Viaje nocturno 77%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_77_percent()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $empProfile = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTime52 = $empProfile->payTravelTime(6, 'nocturna', 'nocturna77');

        $this->assertEquals('2.632,24', $payByTravelTime52);
    }
}
