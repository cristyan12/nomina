<?php

use Faker\Generator as Faker;

$factory->define(App\Models\EmployeeProfile::class, function (Faker $faker) {
    return [
        'employee_id'       => factory(App\Models\Employee::class),
        'profession_id'     => factory(App\Models\Profession::class),
        'bank_id'           => factory(App\Models\Bank::class),
        'account_number'    => $faker->bankAccountNumber,
        'branch_id'         => factory(App\Models\Branch::class),
        'department_id'     => factory(App\Models\Department::class),
        'unit_id'           => factory(App\Models\Unit::class),
        'position_id'       => factory(App\Models\Position::class),
    ];
});
