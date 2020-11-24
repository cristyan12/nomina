<?php

namespace Tests\Unit;

use App\Employee;
use App\EmployeeProfile;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};
use Tests\TestCase;

use PharIo\Manifest\ManifestLoader;
use PharIo\Manifest\ManifestSerializer;

class EmployeeTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    function calculate_the_antiquity_of_employees()
    {
    	$employee = $this->create(Employee::class);
    }
}
