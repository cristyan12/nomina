<?php

namespace Tests\Unit;

use Tests\{TestCase, TestHelpers};
use App\{EmployeeProfile, Position};
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class CalculatePayTest extends TestCase
{
    use RefreshDatabase, TestHelpers;

    protected $position;
    protected $employee;

    public function setUp(): void
    {
        parent::setUp();

        $this->position = $this->create(Position::class, [
            'basic_salary' => 1735.00
        ]);

        $this->employee = $this->create(EmployeeProfile::class, [
            'position_id' => $this->position->id
        ]);
    }

    /** @test */
    function puede_calcular_la_prima_por_trabajo_en_dia_domingo_a_SB()
    {
        $this->assertEquals(2602.50, $this->employee->sundayPremium());
    }

    /** @test */
    function puede_calcular_el_bono_nocturno_a_SB()
    {
        $this->employee->setNightWorkedDays(4)
            ->setMixedWorkedDays(2)
            ->hoursForNigthBonus();

        $this->assertEquals('2.637,20', number_format(
            $this->employee->nightBonusSB(), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_mixto_a_SB()
    {
        $this->employee->setMixedWorkedDays(2)
            ->setSixthDayWorkedMixed(0);

        $TEGMxto = number_format($this->employee->mixedWatchExtraTime(), 2, ',', '.');

        $this->assertEquals('418,71', $TEGMxto);
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_nocturno_a_SB()
    {
        $this->employee->setNightWorkedDays(4);

        $TEGMxto = number_format($this->employee->nigthWatchExtraTime(), 2, ',', '.');

        $this->assertEquals('1.794,49', $TEGMxto);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_descanso_0039()
    {
        $this->prepareParams();

        $salaryNormal = number_format(
            $this->employee->normalSalaryForRest(), 2, ',', '.');

        $this->assertEquals('4.461,37', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_bono_nocturno_0002()
    {
        $this->prepareParams();

        $salaryNormal = number_format(
            $this->employee->normalSalaryForNigthBonus(), 2, ',', '.');

        $this->assertEquals('4.084,62', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_para_prima_dominical_0038()
    {
        $this->prepareParams();

        $salaryNormal = number_format(
            $this->employee->normalSalaryForSundayPremium(), 2, ',', '.');

        $this->assertEquals('4.089,58', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_salario_normal_0001()
    {
        $this->prepareParams();

        $salaryNormal = number_format($this->employee->normalSalary(), 2, ',', '.');

        $this->assertEquals('4.145,19', $salaryNormal);
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_mixto_a_SN()
    {
        $this->prepareParams();

        $this->assertEquals('917,47', number_format(
            $this->employee->mixedWatchExtraTimeSN(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_tiempo_extra_de_guardia_nocturno_a_SN()
    {
        $this->prepareParams();

        $this->assertEquals('3.932,01', number_format(
            $this->employee->nightWatchExtraTimeSN(4), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_tiempo_la_prima_dominical_a_SN()
    {
        $this->prepareParams();

        $this->assertEquals('6.134,37', number_format(
            $this->employee->sundayPremiumSN(), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_bono_nocturno()
    {
        $this->prepareParams();

        $this->assertEquals('6.208,63', number_format(
            $this->employee->nightBonus(), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_horas_extras_diurnas()
    {
        $this->prepareParams();

        $this->assertEquals('1.851,47', number_format(
            $this->employee->dayExtraHours(2), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_horas_extras_mixtas()
    {
        $this->prepareParams();

        $this->assertSame('1.974,90', number_format(
            $this->employee->mixedExtraHours(2), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_horas_extras_nocturnas()
    {
        $this->prepareParams();

        $this->assertSame('2.115,96', number_format(
            $this->employee->nigthExtraHours(2), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_descanso_legal()
    {
        $this->prepareParams();

        $this->assertSame('4.461,37', number_format(
            $this->employee->legalRest(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_descanso_contractual()
    {
        $this->prepareParams();

        $this->assertSame('4.461,37', number_format(
            $this->employee->contractualRest(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_descanso_trabajado()
    {
        $this->prepareParams();

        $this->assertSame('6.692,05', number_format(
            $this->employee->restWorked(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_descanso_compensatorio()
    {
        $this->prepareParams();

        $this->assertSame('4.461,37', number_format(
            $this->employee->compensatoryRest(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_bono_por_el_sexto_dia_trabajado()
    {
        $this->prepareParams();

        $this->assertSame('4.089,58', number_format(
            $this->employee->bonusSixthDayWorked(1), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_las_horas_extras_diurnas_por_retardo_de_transporte()
    {
        $this->prepareParams();

        $this->assertSame('925,73', number_format(
            $this->employee->dayExtraHrsDelayTransport(), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_las_horas_extras_mixtas_por_retardo_de_transporte()
    {
        $this->prepareParams();

        $this->assertSame('1.974,90', number_format(
            $this->employee->mixedExtraHrsDelayTransport(2), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_las_horas_extras_nocturnas_por_retardo_de_transporte()
    {
        $this->prepareParams();

        $this->assertSame('1.057,98', number_format(
            $this->employee->nightExtraHrsDelayTransport(), 2, ',', '.'));
    }

    /** @test */
    function puede_calcular_el_dia_adicional_a_SN_sexto_dia()
    {
        $this->prepareParams();

        $this->assertSame('6.692,05', number_format(
            $this->employee->additionalDaySNSixthDay(), 2, ',', '.'));
    }
}