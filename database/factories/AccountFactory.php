<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    return [
        'company_id' => factory('App\Company'),
        'bank_id' => factory('App\Bank'),
        'number' => $faker->unique()->bankAccountNumber,
        'type' => $faker->randomElement(['Ahorro', 'Corriente']),
        'auth_1' => factory('App\EmployeeProfile'),
        'auth_2' => factory('App\EmployeeProfile'),
        'user_id' => factory('App\User'),
    ];
});
