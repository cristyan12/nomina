<?php

use Faker\Generator as Faker;

$factory->define(App\EmployeeProfile::class, function (Faker $faker) {
    return [
        'employee_id'       => factory(App\Employee::class)->create()->id,
        'profession_id'     => factory(App\Profession::class)->create()->id,
        'bank_id'           => factory(App\Bank::class)->create()->id,
        'account_number'    => $faker->bankAccountNumber,
        'branch_id'         => factory(App\Branch::class)->create()->id,
        'department_id'     => factory(App\Department::class)->create()->id,
        'unit_id'           => factory(App\Unit::class)->create()->id,
        'position_id'       => factory(App\Position::class)->create()->id,
    ];
});
