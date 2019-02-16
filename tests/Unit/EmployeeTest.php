<?php

namespace Tests\Unit;

use App\Employee;
use Carbon\Carbon;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    function calculate_the_antiquity_of_employees()
    {
    	$employee = $this->create(Employee::class, [
    		'hired_at' => '2018-02-01'
    	]);

    	$this->assertInstanceOf(Employee::class, $employee);

    	$diff = $employee->diffAntiquity();

    	$this->assertSame('1 años, 0 meses, y 15 días', $diff);
    }
}
