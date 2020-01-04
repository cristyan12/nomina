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
     * @testdox Salario base por hora en jornada diaria
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
     * @testdox Obtiene el salario base mensual
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
     * @testdox Pago por los dias trabajados diurnos
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
     * @testdox Pago por los dias trabajados mixtos
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
     * @testdox Pago por los dias trabajados nocturnos
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
     * @testdox Pago de horas extras semanales en una jornada diaria
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
     * @testdox Pago de horas extras semanales en una jornada mixta
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
     * @testdox Pago de extras semanales en una jornada nocturna
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
     * @testdox Tiempo de Viaje diario 52%
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
     * @testdox Tiempo de Viaje diario 77%
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
     * @testdox Tiempo de Viaje mixto 52%
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
     * @testdox Tiempo de Viaje mixto 77%
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
     * @testdox Tiempo de Viaje nocturno 52%
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
     * @testdox Tiempo de Viaje nocturno 77%
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
     * @testdox Bono por Tiempo de Viaje nocturno 38%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_of_3_50_hours()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTimeNightly = $employee->payTravelTimeNightly(3.50);

        $this->assertEquals('288,44', $payByTravelTimeNightly);
    }

    /**
     * @test
     * @testdox Pago por sexto dia trabajado
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
     * @testdox Ayuda Única y Especial de Ciudad
     */
    function it_can_calculate_the_pay_for_city_help()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payCityHelp = $employee->payCityHelp();

        $this->assertEquals('2.602,50', $payCityHelp);
    }

    /**
     * @test
     * @testdox Prima dominical SB
     */
    function it_calculate_bonus_per_sunday()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $bonusPerSunday = $employee->bonusPerSunday();

        $this->assertEquals('2.602,50', $bonusPerSunday);
    }

    /**
     * @test
     * @testdox Prima por el sexto dia trabajado a SB
     */
    function it_calculate_bonus_per_six_day_worked()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $bonusPerSixDayWorked = $employee->bonusPerSixDayWorked();

        $this->assertEquals('2.602,50', $bonusPerSixDayWorked);
    }

    /**
     * @test
     * @testdox Obtiene las cantidades para el pago del bono nocturno
     */
    function it_get_the_quantities_for_bonus_night()
    {
        $employee = $this->create('App\EmployeeProfile');

        $mixedWorkedDays = 2;
        $sixthDayWorkedMixed = 1;

        $nigthWorkedDays = 4;
        $sixthDayWorkedNight = 0;

        $quantity = $employee->getQuantityBonusNight(
            $mixedWorkedDays,
            $sixthDayWorkedMixed,
            $nigthWorkedDays,
            $sixthDayWorkedNight
        );

        $this->assertEquals(36, $quantity);
    }

    /**
     * @test
     * @testdox Bono nocturno a SB
     */
    function it_calculate_night_bonus_SB()
    {
        $this->markTestIncomplete();
        return;

        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $nightBonus = $employee->getNightBonusPaySB();

        $this->assertEquals('2.966,85', $nightBonus);
    }
}
