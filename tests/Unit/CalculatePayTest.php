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

        $payByHour = $position->getHoursSalary();

        $this->assertEquals('712,28', $payByHour);
    }

    /** @test */
    // function it_can_calculate_the_pay_for_extra_hours()
    // {
        // Salario base x hora
        // Porcentage para el calculo
        // Establecemos el total de horas extras en la semana
        // Obtenemos el resultado de multiplicar el total de horas extras semanales
        // por el salario base por hora y luego de multiplicar
        // por el porcentage del calculo.
    // }
}
