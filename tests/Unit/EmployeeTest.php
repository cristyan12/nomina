<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\{Employee, EmployeeProfile, Position};
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class EmployeeTest extends TestCase
{
	use DatabaseTransactions;

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
