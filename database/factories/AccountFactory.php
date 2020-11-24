<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Account::class, function (Faker $faker) {
    return [
        'company_id' => factory(App\Models\Company::class),
        'bank_id' => factory(App\Models\Bank::class),
        'number' => $faker->unique()->bankAccountNumber,
        'type' => $faker->randomElement(['Ahorro', 'Corriente']),
        'auth_1' => factory(App\Models\EmployeeProfile::class),
        'auth_2' => factory(App\Models\EmployeeProfile::class),
        'user_id' => factory(App\Models\User::class),
    ];
});
