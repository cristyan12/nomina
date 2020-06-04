<?php

use Faker\Generator as Faker;

$factory->define(App\EmployeeProfile::class, function (Faker $faker) {
    return [
        'employee_id'       => factory(App\Employee::class),
        'profession_id'     => factory(App\Profession::class),
        'bank_id'           => factory(App\Bank::class),
        'account_number'    => $faker->bankAccountNumber,
        'branch_id'         => factory(App\Branch::class),
        'department_id'     => factory(App\Department::class),
        'unit_id'           => factory(App\Unit::class),
        'position_id'       => factory(App\Position::class),
    ];
});
