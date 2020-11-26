<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeProfile;
use App\Models\Position;
use App\Models\Profession;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id'       => Employee::factory(),
            'profession_id'     => Profession::factory(),
            'bank_id'           => Bank::factory(),
            'account_number'    => $this->faker->bankAccountNumber,
            'branch_id'         => Branch::factory(),
            'department_id'     => Department::factory(),
            'unit_id'           => Unit::factory(),
            'position_id'       => Position::factory(),
        ];
    }
}
