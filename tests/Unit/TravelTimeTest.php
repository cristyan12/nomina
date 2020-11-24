<?php

namespace Tests\Unit;

use Tests\{TestCase, TestHelpers};
use App\Models\{EmployeeProfile, Position};
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelTimeTest extends TestCase
{
    use RefreshDatabase;

    private $position;
    private $employee;

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
    function puede_calcular_las_horas_de_tiempo_de_viaje_diurno_a_52_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursDayTravelTime52(1.50)
            ->dayTravelTime52(), 2, ',', '.');

        $this->assertSame($travelTime, '494,48');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_diurno_a_77_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursDayTravelTime77(1.50)
            ->dayTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '575,80');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_mixto_a_52_por_ciento()
    {
        $travelTime = $this->employee
            ->setHoursMixedTravelTime52(3)
            ->mixedTravelTime52();

        $this->assertSame($travelTime, 1054.88);
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_mixto_a_77_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursMixedTravelTime77(3)
            ->mixedTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '1.228,38');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_nocturno_a_52_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursNigthTravelTime52(6)
            ->nigthTravelTime52(), 2, ',', '.');

        $this->assertSame($travelTime, '2.260,46');
    }

    /** @test */
    function puede_calcular_las_horas_de_tiempo_de_viaje_nocturno_a_77_por_ciento()
    {
        $travelTime = number_format($this->employee
            ->setHoursNigthTravelTime77(6)
            ->nigthTravelTime77(), 2, ',', '.');

        $this->assertSame($travelTime, '2.632,24');
    }

    /** @test */
    function puede_calcular_el_bono_por_tiempo_de_viaje_nocturno()
    {
        $bonus = $this->employee->setDayWorkedDays(1)
            ->setMixedWorkedDays(2)
            ->setNightWorkedDays(4)
            ->hoursBonusTravelTimeNight();

        $bonusTravelTimeNight = number_format(
            $this->employee->bonusTravelTimeNight(), 2, ',', '.');

        $this->assertEquals('782,92', $bonusTravelTimeNight);
    }
}
