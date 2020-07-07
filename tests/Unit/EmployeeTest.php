<?php

namespace Tests\Unit;

use App\Employee;
use App\EmployeeProfile;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};
use Tests\TestCase;

class EmployeeTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    function calculate_the_antiquity_of_employees()
    {
    	$employee = $this->create(Employee::class);

    	$this->assertInstanceOf(Employee::class, $employee);

    	$diff = $employee->diffAntiquity();

        $this->assertContains('años', $diff);
        $this->assertContains('meses', $diff);
    	$this->assertContains('días', $diff);
    }
}
