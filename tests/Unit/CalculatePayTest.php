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

    protected $days = [
        'workedDaysMixed' => 0,
        'sixthDayWorkedMixed' => 0,
        'workedDaysNigthly' => 0,
        'sixthDayWorkedNigthly' => 0,
    ];

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

        $payDiurnalWorkedDays = $employee
            ->setWorkedDaysDaily(2)
            ->payWorkedDays();

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

        $payMixedWorkedDays = $employee
            ->setWorkedDaysDaily(2)
            ->payWorkedDays();

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

        $payNightlyWorkedDays = $employee
            ->setWorkedDaysDaily(4)
            ->payWorkedDays();

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

        $payByExtraHours = $employee
            ->setExtraHours(15)
            ->payExtraHours('diaria');

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

        $payByExtraHours = $employee
            ->setExtraHours(15)
            ->payExtraHours('mixta');

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

        $payByExtraHours = $employee
            ->setExtraHours(15)
            ->payExtraHours('nocturna');

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

        $payByTravelTime52 = $employee
            ->setTravelTimeHours(3)
            ->payTravelTime('diaria', 'tvDiaria52');

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

        $payByTravelTime52 = $employee
            ->setTravelTimeHours(3)
            ->payTravelTime('diaria', 'tvDiaria77');

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

        $payByTravelTime52 = $employee
            ->setTravelTimeHours(3)
            ->payTravelTime('mixta', 'tvMixta52');

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

        $payByTravelTime52 = $employee
            ->setTravelTimeHours(3)
            ->payTravelTime('mixta', 'tvMixta77');

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

        $payByTravelTime52 = $employee
            ->setTravelTimeHours(6)
            ->payTravelTime('nocturna', 'tvNocturna52');

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

        $payByTravelTime52 = $employee
            ->setTravelTimeHours(6)
            ->payTravelTime('nocturna', 'tvNocturna77');

        $this->assertEquals('2.632,24', $payByTravelTime52);
    }

    /**
     * @test
     * @testdox Bono por Tiempo de Viaje nocturno 38%
     */
    function it_can_calculate_the_pay_for_travel_time_nightly_of_3_5_hours()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $payByTravelTimeNightly = $employee
            ->setBonusHoursOfNightTravelTime(3.5)
            ->bonusTravelTimeNightly();

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

        $paySixthDayWorked = $employee->paySixthDayWorked();

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

        $daysQBN = array_merge($this->days, ['workedDaysNigthly' => 4]);

        $quantity = $employee
            ->setWorkedDaysMixed($daysQBN['workedDaysMixed'])
            ->setSixthDayWorkedMixed($daysQBN['sixthDayWorkedMixed'])
            ->setWorkedDaysNigthly($daysQBN['workedDaysNigthly'])
            ->setSixthDayWorkedNigthly($daysQBN['sixthDayWorkedNigthly'])
            ->getQuantityBonusNight();

        $this->assertEquals(24, $quantity);
    }

    /**
     * @test
     * @testdox Bono nocturno a SB
     */
    function it_calculate_night_bonus_SB()
    {
        $position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);

        $daysBN = array_merge($this->days, ['workedDaysNigthly' => 4]);

        $nightBonus = $employee->getNightBonusPaySB([
            $daysBN['workedDaysMixed'],
            $daysBN['sixthDayWorkedMixed'],
            $daysBN['workedDaysNigthly'],
            $daysBN['sixthDayWorkedNigthly'],
        ], 0, 0);

        $this->assertEquals('1.977,90', $nightBonus);
    }

    /**
     * @test
     * @testdox Salario Normal (PEG 0001)
     */
    function it_calculate_normal_salary_PEG_0001()
    {
        $this->markTestIncomplete();
        return;

        // Arrange
        $position = $this->create('\App\Position', ['basic_salary' => '1735.00']);
        $employee = $this->create('App\EmployeeProfile', ['position_id' => $position->id]);
        $params = $employee->setWorkedDaysDaily(2)
            ->setWorkedDaysMixed(0)
            ->setWorkedDaysNigthly(4);


        // SB, Dias trabajados diurnos, Dias trabajados mixtos, Dias trabajados nocturnos,
        // Tiempo de Viaje Diurno 52%, Tiempo de Viaje Diurno 77%,
        // Tiempo de Viaje Mixto 52%, Tiempo de Viaje Mixto 77%,
        // Tiempo de Viaje Nocturno 52%, Tiempo de Viaje Nocturno 77%,
        // Pago de comida, Bonif. Tiempo de viaje nocturno, Sexto dia trabajado (Diurno, Mixto o Nocturno),
        // Ayuda de ciudad, Prima Dominical a SB, Prima por sexto dia trabajado a SB, Bono Nocturno a SB

        // se dividen entre las diferentes unidades de tiempo

        // Cantidad de dias trajados diurnos, mixtos y nocturnos, Sexto dia trabajado (D, M y N),
        // Permiso remunerado, Ausencia injustificada, Permiso no remunerado, Enfermedad ambulatoria,
        // Enfermedad profesional, Accidente industrial, Permiso sindical

        $normalSalaryPEG_0001 = $employee->getNormalSalaryPEG_0001();

        $this->assertEquals('3.766,76', $normalSalaryPEG_0001);
    }
}
