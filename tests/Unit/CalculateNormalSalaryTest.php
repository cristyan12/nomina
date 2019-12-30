<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class CalculateNormalSalaryTest extends TestCase
{
    use DatabaseTransactions;

    protected $position;
    protected $employee;

    public function setUp(): void
    {
        parent::setUp();

        $this->position = $this->create('App\Position', ['basic_salary' => '1735.00']);
        $this->employee = $this->create('App\EmployeeProfile', ['position_id' => $this->position->id]);
    }

    /**
     * @test
     * @testdox Calcula el Salario Normal
     */
    function it_can_calculate_normal_salary_PEG_0001()
    {
        $this->markTestIncomplete();
        return;
        
        $normalSalary = $this->employee->getNormalSalary();

        $this->assertEquals('3.766,76', $normalSalary);
    }
}
